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
                    <table class="table table-bordered text-center">
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
                            @for ($week = 0; $week < 5; $week++)
                                <tr>
                                    @for ($day = 0; $day < 7; $day++)
                                        <td class="bg-dark text-white">30</td>
                                    @endfor
                                </tr>
                            @endfor
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
                            <input type="text" name="fullname" class="form-control" required>
                        </div>
                        <div class="form-group mb-2">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
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
                            <input type="date" name="appointment_date" class="form-control" required>
                        </div>
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