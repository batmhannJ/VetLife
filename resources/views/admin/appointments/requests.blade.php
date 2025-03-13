@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-10">
            <div class="p-3">
                
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="appointmentTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="calendar-tab" data-toggle="tab" href="#calendar" role="tab">Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab">List of Appointments</a>
                    </li>
                </ul>
                
                <!-- Tab Content -->
                <div class="tab-content" id="appointmentTabContent">
                    <!-- Calendar View -->
                    <div class="tab-pane fade show active" id="calendar" role="tabpanel">
                        <div class="my-3 d-flex justify-content-between">
                            <h4 id="currentMonth"></h4>
                            <div>
                                <button class="btn btn-primary btn-sm" id="todayBtn">Today</button>
                                <button class="btn btn-secondary btn-sm active" id="monthViewBtn">Month</button>
                                <button class="btn btn-secondary btn-sm" id="dayViewBtn">Day</button>
                                <div class="btn-group">
                                    <button class="btn btn-outline-secondary btn-sm" id="prevMonthBtn"><i class="fas fa-chevron-left"></i></button>
                                    <button class="btn btn-outline-secondary btn-sm" id="nextMonthBtn"><i class="fas fa-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                        
                        <table class="table table-bordered calendar-table">
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
                            <tbody id="calendarBody">
                                <!-- Calendar will be populated by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- List View -->
                    <div class="tab-pane fade" id="list" role="tabpanel">
                        <div class="card mt-3">
                            <div class="card-header">
                                <h5>List of Appointments</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        Show <select class="form-control form-control-sm d-inline-block w-auto">
                                            <option>10</option>
                                            <option>25</option>
                                            <option>50</option>
                                        </select> entries
                                    </div>
                                    <div>
                                        <input type="text" class="form-control form-control-sm" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date Created</th>
                                            <th>Code</th>
                                            <th>Owner</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- If there are appointments, they would be listed here -->
                                        <!-- Empty state message if no appointments -->
                                        <tr>
                                            <td colspan="6" class="text-center">No appointments available at the moment.</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        Showing 0 to 0 of 0 entries
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-sm">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Previous</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .sidebar {
        min-height: 100vh;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .calendar-table td {
        height: 100px;
        width: 14.28%;
        vertical-align: top;
        padding: 5px;
        background-color: #343a40;
        color: white;
    }
    
    .calendar-table th {
        background-color: #343a40;
        color: white;
        text-align: center;
    }
    
    .nav-link.active {
        background-color: #007bff !important;
        color: white !important;
    }
    
    .date-number {
        font-weight: bold;
        margin-bottom: 5px;
    }
    
    .appointment-indicator {
        background-color: #28a745;
        color: white;
        border-radius: 3px;
        padding: 2px 5px;
        font-size: 0.8rem;
        margin-bottom: 2px;
        cursor: pointer;
    }
    
    .today {
        background-color: #007bff !important;
    }
    
    .other-month {
        opacity: 0.5;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Current date tracking
        let currentDate = new Date();
        let currentMonth = currentDate.getMonth();
        let currentYear = currentDate.getFullYear();
        
        // Sample appointments data (you would fetch this from your backend)
        const sampleAppointments = [
            { id: 1, title: "Dr. Smith", date: new Date(2024, 2, 15), status: "Confirmed" },
            { id: 2, title: "Dr. Johnson", date: new Date(2024, 2, 20), status: "Pending" },
            { id: 3, title: "Dr. Williams", date: new Date(2024, 2, 22), status: "Confirmed" },
            { id: 4, title: "Dr. Brown", date: new Date(2024, 3, 5), status: "Confirmed" },
            { id: 5, title: "Dr. Davis", date: new Date(2024, 3, 12), status: "Pending" }
        ];
        
        // Initialize calendar
        renderCalendar(currentMonth, currentYear);
        
        // Button event handlers
        $('#prevMonthBtn').click(function() {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });
        
        $('#nextMonthBtn').click(function() {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });
        
        $('#todayBtn').click(function() {
            const today = new Date();
            currentMonth = today.getMonth();
            currentYear = today.getFullYear();
            renderCalendar(currentMonth, currentYear);
        });
        
        // Function to render the calendar
        function renderCalendar(month, year) {
            // Update header
            const monthNames = ["January", "February", "March", "April", "May", "June",
                               "July", "August", "September", "October", "November", "December"];
            $('#currentMonth').text(monthNames[month] + " " + year);
            
            // Clear previous calendar
            $('#calendarBody').empty();
            
            // Get first day of month and last day
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            
            // Get last day of previous month for filling in
            const daysInPrevMonth = new Date(year, month, 0).getDate();
            
            let date = 1;
            let nextMonthDate = 1;
            
            // Build calendar rows
            for (let i = 0; i < 6; i++) {
                // Only render 6 rows if needed
                if (date > daysInMonth && i > 0) break;
                
                const row = document.createElement("tr");
                
                // Create cells for each day of the week
                for (let j = 0; j < 7; j++) {
                    const cell = document.createElement("td");
                    
                    if (i === 0 && j < firstDay) {
                        // Previous month days
                        const prevMonthDay = daysInPrevMonth - firstDay + j + 1;
                        const prevMonth = month - 1 < 0 ? 11 : month - 1;
                        const prevYear = prevMonth === 11 ? year - 1 : year;
                        
                        cell.innerHTML = `<div class="date-number other-month">${prevMonthDay}</div>`;
                        cell.setAttribute('data-date', `${prevYear}-${prevMonth+1}-${prevMonthDay}`);
                        
                        // Add any appointments for this date from previous month
                        addAppointmentsToCell(cell, prevYear, prevMonth, prevMonthDay);
                    }
                    else if (date > daysInMonth) {
                        // Next month days
                        const nextMonth = month + 1 > 11 ? 0 : month + 1;
                        const nextYear = nextMonth === 0 ? year + 1 : year;
                        
                        cell.innerHTML = `<div class="date-number other-month">${nextMonthDate}</div>`;
                        cell.setAttribute('data-date', `${nextYear}-${nextMonth+1}-${nextMonthDate}`);
                        
                        // Add any appointments for this date from next month
                        addAppointmentsToCell(cell, nextYear, nextMonth, nextMonthDate);
                        nextMonthDate++;
                    }
                    else {
                        // Current month days
                        cell.innerHTML = `<div class="date-number">${date}</div>`;
                        cell.setAttribute('data-date', `${year}-${month+1}-${date}`);
                        
                        // Highlight today
                        const today = new Date();
                        if (date === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                            cell.classList.add('today');
                        }
                        
                        // Add any appointments for this date
                        addAppointmentsToCell(cell, year, month, date);
                        
                        date++;
                    }
                    
                    row.appendChild(cell);
                }
                
                $('#calendarBody').append(row);
            }
        }
        
        // Function to add appointments to a calendar cell
        function addAppointmentsToCell(cell, year, month, day) {
            // Find appointments for this day
            const cellDate = new Date(year, month, day);
            const dayAppointments = sampleAppointments.filter(appointment => 
                appointment.date.getDate() === cellDate.getDate() && 
                appointment.date.getMonth() === cellDate.getMonth() && 
                appointment.date.getFullYear() === cellDate.getFullYear()
            );
            
            // Add appointment indicators
            dayAppointments.forEach(appointment => {
                const appointmentDiv = document.createElement('div');
                appointmentDiv.className = 'appointment-indicator';
                appointmentDiv.textContent = appointment.title;
                appointmentDiv.setAttribute('data-appointment-id', appointment.id);
                
                // Add click handler to show appointment details (implement this based on your needs)
                appointmentDiv.addEventListener('click', function(e) {
                    e.stopPropagation();
                    alert('Appointment details: ' + appointment.title);
                    // You could show a modal with appointment details here
                });
                
                cell.appendChild(appointmentDiv);
            });
            
            // Add click event to the day cell for adding new appointments
            $(cell).click(function() {
                const clickedDate = $(this).attr('data-date');
                alert('Add new appointment on ' + clickedDate);
                // You could show a modal for adding a new appointment here
            });
        }
    });
</script>
@endsection