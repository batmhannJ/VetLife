@extends('layouts.admin') 
@section('content')
    <div class="container">
        <h1>Edit Appointment</h1>

        <form action="{{ route('admin.appointments.update', $appointment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" name="fullname" id="fullname" class="form-control" value="{{ $appointment->fullname }}">
            </div>

            <div class="form-group">
                <label for="ailment">Ailment</label>
                <input type="text" name="ailment" id="ailment" class="form-control" value="{{ $appointment->ailment }}">
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="datetime-local" name="appointment_date" id="appointment_date" class="form-control" value="{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d\TH:i') }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="Pending" {{ $appointment->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Approved" {{ $appointment->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                    <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Appointment</button>
        </form>
    </div>
@endsection