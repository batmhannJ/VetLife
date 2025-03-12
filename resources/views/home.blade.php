@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Doctor's Dashboard</h3>
                    <p class="text-muted">Welcome to Health Welness Dashboard</p>
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Statistics Summary Cards -->
                    <div class="row mb-4">
                        <div class="{{ $settings1['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-info" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-user-md"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings1['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings1['total_number']) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="{{ $settings2['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-success" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-users"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings2['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings2['total_number']) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="{{ $settings3['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-calendar-check"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings3['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings3['total_number']) }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="{{ $settings4['column_class'] }}">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger" style="display:flex; flex-direction: column; justify-content: center;">
                                    <i class="fa fa-prescription-bottle-alt"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $settings4['chart_title'] }}</span>
                                    <span class="info-box-number">{{ number_format($settings4['total_number']) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Appointment Chart -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        Appointment Chart
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="appointmentChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Latest Appointments Table -->
                        <div class="{{ $settings5['column_class'] }}">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">{{ $settings5['chart_title'] }}</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                @foreach($settings5['fields'] as $field)
                                                    <th>{{ ucfirst($field) }}</th>
                                                @endforeach
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($settings5['data'] as $row)
                                                <tr>
                                                    @foreach($settings5['fields'] as $field)
                                                        <td>{{ $row->{$field} }}</td>
                                                    @endforeach
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-sm btn-info">View</button>
                                                            <button type="button" class="btn btn-sm btn-success">Confirm</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="{{ count($settings5['fields']) + 1 }}">{{ __('No entries found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Latest Prescriptions Table -->
                        <div class="{{ $settings6['column_class'] }}">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title">{{ $settings6['chart_title'] }}</h3>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                @foreach($settings6['fields'] as $field)
                                                    <th>{{ ucfirst($field) }}</th>
                                                @endforeach
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($settings6['data'] as $row)
                                                <tr>
                                                    @foreach($settings6['fields'] as $field)
                                                        <td>{{ $row->{$field} }}</td>
                                                    @endforeach
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info">View</button>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="{{ count($settings6['fields']) + 1 }}">{{ __('No entries found') }}</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Access Buttons -->
                    <div class="row mt-4">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Add Doctor</h3>
                                    <p>Create new doctor account</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <a href="{{ route('admin.doctors.create') }}" class="small-box-footer">
                                    Create Doctor <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Add Patient</h3>
                                    <p>Register new patient</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <a href="{{ route('admin.patients.create') }}" class="small-box-footer">
                                    Add Patient <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>Schedule</h3>
                                    <p>View and manage schedules</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <a href="{{ route('admin.schedules.index') }}" class="small-box-footer">
                                    Manage Schedule <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Reports</h3>
                                    <p>Generate clinical reports</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <a href="{{ route('admin.reports.index') }}" class="small-box-footer">
                                    View Reports <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
    // Appointment Chart
    $(function() {
        var ctx = document.getElementById('appointmentChart').getContext('2d');
        var appointmentChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [
                    {
                        label: 'New Appointments',
                        backgroundColor: '#28a745',
                        data: [65, 59, 80, 81, 56, 55]
                    },
                    {
                        label: 'Completed',
                        backgroundColor: '#17a2b8',
                        data: [55, 49, 70, 71, 46, 45]
                    },
                    {
                        label: 'Cancelled',
                        backgroundColor: '#dc3545',
                        data: [10, 10, 10, 10, 10, 10]
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection