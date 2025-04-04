@extends('layouts.patient')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <!-- Appointment Schedule -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Appointment Schedule</div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-sm btn-outline-secondary" id="prevMonth">&lt; Previous</button>
                        <h5 class="mb-0" id="currentMonthYear">{{ date('F Y') }}</h5>
                        <button class="btn btn-sm btn-outline-secondary" id="nextMonth">Next &gt;</button>
                    </div>
                    <table class="table table-bordered text-center" id="appointmentCalendar">
                        <thead>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Calendar will be populated via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Appointment Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Appointment Form</div>
                <div class="card-body">
                    <form action="{{ route('patient.appointments.store') }}" method="POST">                        
                        @csrf
                        <div class="form-group mb-2">
                            <label>Fullname</label>
                            <input type="text" name="fullname" class="form-control" required value="{{ auth()->user()->name ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ auth()->user()->email ?? '' }}">
                        </div>
                        <div class="form-group mb-2">
                            <label>Contact</label>
                            <input type="text" name="contact" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Gender</label>
                            <select name="gender" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Ailment</label>
                            <input type="text" name="ailment" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Appointment Date</label>
                            <input type="date" name="appointment_date" id="appointmentDate" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Appointment Time</label>
                            <input type="time" name="appointment_time" class="form-control" required>
                        </div>
                        <input type="hidden" name="selected_date_formatted" id="selectedDateFormatted">
                        <div class="form-group mb-2">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="Pending" readonly>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Appointment</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    const MAX_APPOINTMENTS_PER_DAY = 20; // Maximum appointments per day - set as constant
    
    let appointmentData = {};
    let availableDays = []; // Will store the days from the schedule
    
    // First fetch the available days from the schedule
    function fetchAvailableDays() {
        fetch('/schedules/available-days', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response text:', text);
                    throw new Error(`Server returned ${response.status}: ${text}`);
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('Available days fetched:', data);
            availableDays = data.days || [];
            fetchAppointmentCounts();
        })
        .catch(error => {
            console.error('Error fetching available days:', error);
            // Default to all days if there's an error
            availableDays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
            fetchAppointmentCounts();
        });
    }
    
    function fetchAppointmentCounts() {
        const url = '/appointments/counts';
        console.log('Fetching appointment counts from URL:', url);
        
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            credentials: 'same-origin'
        })
        .then(response => {
            console.log('Response status:', response.status);
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response text:', text);
                    throw new Error(`Server returned ${response.status}: ${text}`);
                });
            }
            
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                return response.text().then(text => {
                    console.error('Invalid content type or non-JSON response:', text.substring(0, 100) + '...');
                    throw new Error('Response is not JSON');
                });
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Appointment data fetched successfully:', data);
            appointmentData = data;
            renderCalendar();
        })
        .catch(error => {
            console.error('Error fetching appointment data:', error);
            // Continue with empty appointment data rather than failing completely
            appointmentData = {};
            renderCalendar(); 
        });
    }
    
    function renderCalendar() {
        const calendarBody = document.querySelector('#appointmentCalendar tbody');
        calendarBody.innerHTML = '';
        
        document.getElementById('currentMonthYear').textContent = 
            new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
        
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        
        let date = 1;
        
        for (let i = 0; i < 6; i++) {
            const row = document.createElement('tr');
            
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                
                if (i === 0 && j < firstDay) {
                    cell.textContent = '';
                } else if (date > daysInMonth) {
                    cell.textContent = '';
                } else {
                    const dateObj = new Date(currentYear, currentMonth, date);
                    const dayName = dateObj.toLocaleString('en-US', { weekday: 'long' });
                    const isDayAvailable = availableDays.includes(dayName);
                    
                    const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    console.log(`Date ${dateStr}, day: ${dayName}, available: ${isDayAvailable}`);

                    const appointmentsForDate = appointmentData[dateStr] || 0;
                    
                    const availableAppointments = isDayAvailable ? (MAX_APPOINTMENTS_PER_DAY - appointmentsForDate) : 0;
                    
                    const dateDisplay = document.createElement('div');
                    dateDisplay.textContent = date;
                    dateDisplay.className = 'fw-bold';
                    
                    const availabilityDisplay = document.createElement('div');
                    
                    if (isDayAvailable) {
                        availabilityDisplay.textContent = `${availableAppointments} available`;
                    } else {
                        availabilityDisplay.textContent = 'Not available';
                    }
                    
                    availabilityDisplay.className = 'small';
                    
                    const wrapper = document.createElement('div');
                    wrapper.className = 'date-cell';
                    wrapper.appendChild(dateDisplay);
                    wrapper.appendChild(availabilityDisplay);
                    
                    cell.appendChild(wrapper);
                    
                    if (date === new Date().getDate() && 
                        currentMonth === new Date().getMonth() && 
                        currentYear === new Date().getFullYear()) {
                        cell.classList.add('bg-info', 'text-white');
                    }
                    
                    if (!isDayAvailable) {
                        cell.classList.add('bg-secondary', 'text-white');
                    } else if (availableAppointments <= 0) {
                        cell.classList.add('bg-danger', 'text-white');
                    } else if (availableAppointments < 10) {
                        cell.classList.add('bg-warning');
                    } else {
                        cell.classList.add('bg-success', 'text-white');
                    }
                    
                    cell.dataset.date = dateStr;
                    
                    if (isDayAvailable && availableAppointments > 0) {
                        cell.style.cursor = 'pointer';
                        cell.addEventListener('click', function() {
                            document.getElementById('appointmentDate').value = dateStr;
                            document.getElementById('selectedDateFormatted').value = dateStr;
                            
                            document.querySelectorAll('#appointmentCalendar td.selected').forEach(el => {
                                el.classList.remove('selected', 'bg-primary');
                            });
                            this.classList.add('selected', 'bg-primary');
                        });
                    } else {
                        cell.addEventListener('click', function() {
                            if (!isDayAvailable) {
                                alert('No appointments scheduled for this day of the week.');
                            } else {
                                alert('No appointments available for this date.');
                            }
                        });
                    }
                    
                    date++;
                }
                
                row.appendChild(cell);
            }
            
            calendarBody.appendChild(row);
            
            if (date > daysInMonth) {
                break;
            }
        }
    }
    
    document.getElementById('prevMonth').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        fetchAppointmentCounts();
    });
    
    document.getElementById('nextMonth').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        fetchAppointmentCounts();
    });
    
    // Start by fetching available days first
    fetchAvailableDays();
    
    const style = document.createElement('style');
    style.textContent = `
        .date-cell {
            padding: 5px;
            min-height: 60px;
        }
        #appointmentCalendar td {
            height: 80px;
            vertical-align: top;
        }
    `;
    document.head.appendChild(style);

    const appointmentForm = document.querySelector('form');
    if (appointmentForm) {
        const timeField = document.querySelector('input[name="appointment_time"]');
        if (timeField && !timeField.value) {
            timeField.value = '08:00'; // Default to 8:00 AM
        }
        
        appointmentForm.addEventListener('submit', function(event) {
            event.preventDefault(); 

            const selectedDate = document.getElementById('appointmentDate').value;
            if (!selectedDate) {
                alert('Please select a date from the calendar.');
                return;
            }
            
            const dateObj = new Date(selectedDate);
            const dayName = dateObj.toLocaleString('en-US', { weekday: 'long' });
            const isDayAvailable = availableDays.includes(dayName);
            
            if (!isDayAvailable) {
                alert('No appointments scheduled for this day of the week.');
                return;
            }
            
            const dateStr = selectedDate;
            const appointmentsForDate = appointmentData[dateStr] || 0;
            const availableAppointments = MAX_APPOINTMENTS_PER_DAY - appointmentsForDate;
            
            if (availableAppointments <= 0) {
                alert('No appointments available for this date.');
                return;
            }
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Appointment submission response:', data);
                
                if (data.success) {
                    alert('Appointment created successfully!');
                    this.reset();
                    
                    document.querySelectorAll('#appointmentCalendar td.selected').forEach(el => {
                        el.classList.remove('selected', 'bg-primary');
                    });
                    
                    // Instead of manually updating the local data, fetch fresh data
                    fetchAppointmentCounts();
                } else {
                    alert('Failed to create appointment: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error submitting appointment:', error);
                alert('An error occurred while submitting the form.');
            });
        });
    }
});
</script>
@endsection