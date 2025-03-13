@extends('layouts.patient')

@section('title', 'Appointment Details')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Appointment Details</h3>
                </div>
                <div class="card-body">
                    @if($appointment)
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</p>
                                <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                                <p><strong>Ailment:</strong> {{ $appointment->ailment }}</p>
                                <p><strong>Status:</strong> 
                                    @if($appointment->status == 'Pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($appointment->status == 'Confirmed')
                                        <span class="badge bg-success">Confirmed</span>
                                    @elseif($appointment->status == 'Completed')
                                        <span class="badge bg-info">Completed</span>
                                    @elseif($appointment->status == 'Cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $appointment->status }}</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Full Name:</strong> {{ $appointment->fullname }}</p>
                                <p><strong>Email:</strong> {{ $appointment->email }}</p>
                                <p><strong>Contact:</strong> {{ $appointment->contact }}</p>
                                <p><strong>Gender:</strong> {{ $appointment->gender }}</p>
                                <p><strong>Date of Birth:</strong> {{ \Carbon\Carbon::parse($appointment->dob)->format('M d, Y') }}</p>
                                <p><strong>Address:</strong> {{ $appointment->address }}</p>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            Appointment not found.
                        </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('patient.appointments.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection