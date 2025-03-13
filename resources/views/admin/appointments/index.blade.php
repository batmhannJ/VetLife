@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Menu - Similar to the one in the image -->
        <div class="col-md-2 sidebar bg-dark text-white">
            <div class="p-3">
                <div class="d-flex align-items-center mb-4">
                    <img src="/logo.png" alt="Logo" class="mr-2" style="width: 30px;">
                    <span class="font-weight-bold">CLINIC SYSTEM</span>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/dashboard">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/doctor">
                            <i class="fas fa-user-md mr-2"></i> Doctor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/patient">
                            <i class="fas fa-user mr-2"></i> Patient
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white active" href="/appointment">
                            <i class="fas fa-calendar-check mr-2"></i> Appointment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/prescription">
                            <i class="fas fa-prescription mr-2"></i> Prescription
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/payment">
                            <i class="fas fa-credit-card mr-2"></i> Payment
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/invoice">
                            <i class="fas fa-file-invoice mr-2"></i> Invoice
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/schedule">
                            <i class="fas fa-calendar-alt mr-2"></i> Schedule
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/emergency">
                            <i class="fas fa-ambulance mr-2"></i> Emergency Help
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="col-md-10">
            <div class="p-3">
                <!-- Top User Info -->
                <div class="d-flex justify-content-end mb-4">
                    <div class="user-info">
                        <span>USER #123</span>
                    </div>
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
                            <h4>May 2024</h4>
                            <div>
                                <button class="btn btn-primary btn-sm">Today</button>
                                <button class="btn btn-secondary btn-sm">Month</button>
                                <button class="btn btn-secondary btn-sm">Day</button>
                                <div class="btn-group">
                                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-left"></i></button>
                                    <button class="btn btn-outline-secondary btn-sm"><i class="fas fa-chevron-right"></i></button>
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
                            <tbody>
                                <!-- Calendar grid would be populated dynamically -->
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                </tr>
                                <!-- Additional rows for the full month -->
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
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // JavaScript to handle appointment calendar functionality
    });
</script>
@endsection