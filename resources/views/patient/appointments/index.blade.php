@extends('layouts.patient')

@section('title', 'My Appointments')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>My Appointments</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('patient.dashboard') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Book New Appointment
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            Appointment History
        </div>
        <div class="card-body">
            @if($appointments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Ailment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                                    <td>{{ $appointment->ailment }}</td>
                                    <td>
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
                                    </td>
                                    <td>
                                        <a href="{{ route('patient.appointments.show', $appointment->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        
                                        @if($appointment->status == 'Pending')
                                            <form action="{{ route('patient.appointments.destroy', $appointment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this appointment?')">
                                                <i class="fas fa-times-circle"></i> Cancel
                                            </button>
                                            </form>
                                            @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p>You don't have any appointments yet.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endsection