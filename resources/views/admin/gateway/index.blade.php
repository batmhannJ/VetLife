@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1>Gateway Side - Patient Reminders</h1>
    
    <div class="card">
        <div class="card-header">
            <h5>Patient Information</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Patient Name</th>
                        <th>Phone Number</th>
                        <th>Appointment Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td>
                            <span class="badge bg-warning">
                                {{ $appointment->appointment_date >= date('Y-m-d') ? 'Pending' : 'Past' }}
                            </span>
                        </td>
                        <td>{{ $appointment->fullname }}</td>
                        <td>{{ $appointment->contact }}</td>
                        <td>{{ date('M d, Y', strtotime($appointment->appointment_date)) }} at {{ date('h:i A', strtotime($appointment->appointment_time)) }}</td>
                        <td>
                            <a href="{{ route('admin.gateway.remind', $appointment->id) }}" class="btn btn-warning">
                                Remind
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No appointments found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    
    .card-header {
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
    }
    
    .form-control {
        border-radius: 5px;
    }
    
    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #212529;
    }
    
    .rounded-circle {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .table th {
        border-top: none;
        font-weight: 500;
        color: #6c757d;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
    }
</style>
@endsection