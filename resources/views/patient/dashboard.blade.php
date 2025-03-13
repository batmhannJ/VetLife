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
    // Initial variables
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let maxAppointmentsPerDay = 30; // Maximum appointments per day
    
    // Fetch appointment data
    let appointmentData = {}; // Will be populated from AJAX request
    
    // Function to fetch appointment counts
    function fetchAppointmentCounts() {
        // Use GET request to match your original code
        fetch('{{ route("patient.appointments.counts") }}')
            .then(response => response.json())
            .then(data => {
                appointmentData = data;
                renderCalendar();
                console.log('Appointment data fetched successfully');
            })
            .catch(error => {
                console.error('Error fetching appointment data:', error);
                renderCalendar(); // Render calendar anyway
            });
    }
    
    // Function to generate calendar
    function renderCalendar() {
        const calendarBody = document.querySelector('#appointmentCalendar tbody');
        calendarBody.innerHTML = '';
        
        // Update month and year display
        document.getElementById('currentMonthYear').textContent = 
            new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long', year: 'numeric' });
        
        // Get first day of month
        const firstDay = new Date(currentYear, currentMonth, 1).getDay();
        
        // Get number of days in month
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        
        // Variables for calendar generation
        let date = 1;
        
        // Create calendar rows
        for (let i = 0; i < 6; i++) {
            // Create row
            const row = document.createElement('tr');
            
            // Create cells
            for (let j = 0; j < 7; j++) {
                const cell = document.createElement('td');
                
                if (i === 0 && j < firstDay) {
                    // Empty cells before first day of month
                    cell.textContent = '';
                } else if (date > daysInMonth) {
                    // Empty cells after last day of month
                    cell.textContent = '';
                } else {
                    // Cells with dates
                    const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                    const appointmentsForDate = appointmentData[dateStr] || 0;
                    const availableAppointments = maxAppointmentsPerDay - appointmentsForDate;
                    
                    // Create date display
                    const dateDisplay = document.createElement('div');
                    dateDisplay.textContent = date;
                    dateDisplay.className = 'fw-bold';
                    
                    // Create availability display
                    const availabilityDisplay = document.createElement('div');
                    availabilityDisplay.textContent = `${availableAppointments} available`;
                    availabilityDisplay.className = 'small';
                    
                    // Create clickable wrapper
                    const wrapper = document.createElement('div');
                    wrapper.className = 'date-cell';
                    wrapper.appendChild(dateDisplay);
                    wrapper.appendChild(availabilityDisplay);
                    
                    // Add date to cell
                    cell.appendChild(wrapper);
                    
                    // Highlight today's date
                    if (date === new Date().getDate() && 
                        currentMonth === new Date().getMonth() && 
                        currentYear === new Date().getFullYear()) {
                        cell.classList.add('bg-info', 'text-white');
                    }
                    
                    // Style based on availability
                    if (availableAppointments <= 0) {
                        cell.classList.add('bg-danger', 'text-white');
                    } else if (availableAppointments < 10) {
                        cell.classList.add('bg-warning');
                    } else {
                        cell.classList.add('bg-success', 'text-white');
                    }
                    
                    // Make cell clickable for appointment selection
                    cell.dataset.date = dateStr;
                    cell.style.cursor = 'pointer';
                    cell.addEventListener('click', function() {
                        if (availableAppointments > 0) {
                            // Set the date in the appointment form
                            document.getElementById('appointmentDate').value = dateStr;
                            document.getElementById('selectedDateFormatted').value = dateStr;
                            
                            // Highlight the selected cell
                            document.querySelectorAll('#appointmentCalendar td.selected').forEach(el => {
                                el.classList.remove('selected', 'bg-primary');
                            });
                            this.classList.add('selected', 'bg-primary');
                        }
                    });
                    
                    date++;
                }
                
                row.appendChild(cell);
            }
            
            calendarBody.appendChild(row);
            
            // Stop if we've used all days of the month
            if (date > daysInMonth) {
                break;
            }
        }
    }
    
    // Navigate to previous month
    document.getElementById('prevMonth').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        fetchAppointmentCounts();
    });
    
    // Navigate to next month
    document.getElementById('nextMonth').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        fetchAppointmentCounts();
    });
    
    // Initial fetch and render
    fetchAppointmentCounts();
    
    // Styling for calendar
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

    // Fix for appointment form submission
    const appointmentForm = document.querySelector('form');
    if (appointmentForm) {
        // Fix for time field
        const timeField = document.querySelector('input[name="appointment_time"]');
        if (timeField && !timeField.value) {
            timeField.value = '08:00'; // Default to 8:00 AM
        }
// Modify the form submission handler in dashboard.blade.php
appointmentForm.addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    // Get selected time and explicitly log it for debugging
    const timeField = document.querySelector('input[name="appointment_time"]');
    const selectedTime = timeField.value;
    console.log('Selected time before submission:', selectedTime);
    
    // Create FormData object
    const formData = new FormData(this);
    
    // Double-check what's in formData
    console.log('FormData appointment_time:', formData.get('appointment_time'));
    
    // Submit the form via AJAX with explicit Content-Type
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
            // Don't set Content-Type for FormData - browser will set it with boundary
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            // Update UI logic here
            alert('Appointment created successfully!');
            // Don't reset form yet - for debugging purposes
        } else {
            alert('Failed to create appointment: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting the form.');
    });
});
    }
});
</script>
@endsection