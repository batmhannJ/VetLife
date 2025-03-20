@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-10">
            <div class="p-3">
                <!-- Top User Info -->
                <div class="d-flex justify-content-between mb-4">
                    <h2>Appointments</h2>
                </div>
                
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
                                        Show 
                                        <select class="form-control form-control-sm d-inline-block w-auto" id="entriesPerPage">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                        </select> 
                                        entries
                                    </div>
                                    <div>
                                        <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Search...">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="appointmentsTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date Created</th>
                                            <th>Appointment Date</th>
                                            <th>Code</th>
                                            <th>Patient</th>
                                            <th>Ailment</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($appointments) && $appointments->count() > 0)
                                            @foreach($appointments as $key => $appointment)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $appointment->created_at->format('M d, Y') }}</td>
                                                    <td>{{ date('M d, Y g:i A', strtotime($appointment->appointment_date)) }}</td>
                                                    <td>{{ $appointment->code ?? 'APP-' . str_pad($appointment->id, 5, '0', STR_PAD_LEFT) }}</td>
                                                    <td>{{ $appointment->fullname ?? 'N/A' }}</td> 
                                                    <td>{{ $appointment->ailment ?? 'N/A' }}</td> 
                                                    <td>
                                                    <span class="badge badge-{{ $appointment->status == 'Pending' ? 'warning' : ($appointment->status == 'Approved' ? 'success' : ($appointment->status == 'Completed' ? 'primary' : ($appointment->status == 'Cancelled' ? 'danger' : 'secondary'))) }}">
                                                        {{ ucfirst($appointment->status) }}
                                                    </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a href="{{ route('admin.appointments.show', $appointment->id) }}" class="btn btn-sm btn-info">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal{{ $appointment->id }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                        
                                                        <!-- Delete Modal -->
                                                        <div class="modal fade" id="deleteModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want to delete this appointment?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">No appointments available at the moment.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if(isset($appointments) && $appointments->count() > 0)
                                            Showing 1 to {{ $appointments->count() }} of {{ $appointments->count() }} entries
                                        @else
                                            Showing 0 to 0 of 0 entries
                                        @endif
                                    </div>
                                    <nav>
                                        <ul class="pagination pagination-sm" id="appointmentPagination">
                                            <!-- Pagination will be handled by JavaScript -->
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
    
    .btn-group .btn {
        margin-right: 2px;
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
        
        // Store appointment data after fetching
        let appointmentData = {};
        
        // Fetch appointment counts from the server
        function fetchAppointmentCounts() {
            $.ajax({
                url: "{{ route('admin.appointment.counts') }}",
                method: "GET",
                dataType: "json",
                success: function(data) {
                    appointmentData = data;
                    renderCalendar(currentMonth, currentYear);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching appointment data:", error);
                    // Render calendar anyway, but without appointment data
                    renderCalendar(currentMonth, currentYear);
                }
            });
        }
        
        // Initial fetch
        fetchAppointmentCounts();
        
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
        
        $('#monthViewBtn').click(function() {
            $(this).addClass('active');
            $('#dayViewBtn').removeClass('active');
            // Implement month view logic here
        });
        
        $('#dayViewBtn').click(function() {
            $(this).addClass('active');
            $('#monthViewBtn').removeClass('active');
            // Implement day view logic here
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
                        cell.setAttribute('data-date', `${prevYear}-${String(prevMonth+1).padStart(2, '0')}-${String(prevMonthDay).padStart(2, '0')}`);
                        
                        // Add any appointments for this date from previous month
                        addAppointmentsToCell(cell, prevYear, prevMonth, prevMonthDay);
                    }
                    else if (date > daysInMonth) {
                        // Next month days
                        const nextMonth = month + 1 > 11 ? 0 : month + 1;
                        const nextYear = nextMonth === 0 ? year + 1 : year;
                        
                        cell.innerHTML = `<div class="date-number other-month">${nextMonthDate}</div>`;
                        cell.setAttribute('data-date', `${nextYear}-${String(nextMonth+1).padStart(2, '0')}-${String(nextMonthDate).padStart(2, '0')}`);
                        
                        // Add any appointments for this date from next month
                        addAppointmentsToCell(cell, nextYear, nextMonth, nextMonthDate);
                        nextMonthDate++;
                    }
                    else {
                        // Current month days
                        cell.innerHTML = `<div class="date-number">${date}</div>`;
                        cell.setAttribute('data-date', `${year}-${String(month+1).padStart(2, '0')}-${String(date).padStart(2, '0')}`);
                        
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
        
        function addAppointmentsToCell(cell, year, month, day) {
            // Format the date as YYYY-MM-DD to match the format from the server
            const formattedMonth = month + 1; // JavaScript months are 0-indexed
            const paddedMonth = formattedMonth < 10 ? `0${formattedMonth}` : formattedMonth;
            const paddedDay = day < 10 ? `0${day}` : day;
            const dateKey = `${year}-${paddedMonth}-${paddedDay}`;
            
            // Check if there are appointments for this date
            if (appointmentData[dateKey] && appointmentData[dateKey] > 0) {
                const appointmentDiv = document.createElement('div');
                appointmentDiv.className = 'appointment-indicator';
                
                // Use actual count from the database
                const count = appointmentData[dateKey];
                appointmentDiv.textContent = `${count} appointment${count > 1 ? 's' : ''}`;
                
                // Add click handler to show appointment details
                appointmentDiv.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Redirect to filtered appointments list
                    window.location.href = `{{ route('admin.appointments.index') }}?date=${dateKey}`;
                });
                
                cell.appendChild(appointmentDiv);
            }
            
            // Add click event to the day cell for adding new appointments
            $(cell).click(function() {
                const clickedDate = $(this).attr('data-date');
                window.location.href = `{{ route('admin.appointments.create') }}?date=${clickedDate}`;
            });
        }
        
        // Search functionality
        $('#searchInput').on('keyup', function() {
            const value = $(this).val().toLowerCase();
            $("#appointmentsTable tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        
        // Entries per page change
        $('#entriesPerPage').change(function() {
            const perPage = parseInt($(this).val());
            // Implement pagination logic here
        });
    });
</script>
@endsection