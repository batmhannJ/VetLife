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
    $(function() {
        var ctx = document.getElementById('appointmentChart').getContext('2d');

        // Sample data for demonstration purposes
        // IMPORTANT: Replace this with your actual data retrieval logic in your controller.
        var appointmentData = {!! json_encode($appointmentData) !!};

        var chartData = {
            labels: Object.keys(appointmentData),
            datasets: [
                {
                    label: 'Appointments',
                    backgroundColor: [
                        '#5bc0de',
                        '#d9534f',
                        '#28a745',
                        '#f0ad4e'
                    ],
                    data: Object.values(appointmentData)
                }
            ]
        };

        var appointmentChart = new Chart(ctx, {
            type: 'bar', // Or 'pie', 'doughnut', etc.
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                 plugins: {
                    legend: {
                        position: 'top', // Optional: Position the legend
                    },
                }
            }
        });
    });
</script>
@endsection
