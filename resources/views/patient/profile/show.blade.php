@extends('layouts.patient')

@section('title', 'My Profile')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end">Name:</div>
                        <div class="col-md-8">{{ $user->name }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end">Email:</div>
                        <div class="col-md-8">{{ $user->email }}</div>
                    </div>

                    @if($user->contact)
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end">Contact:</div>
                        <div class="col-md-8">{{ $user->contact }}</div>
                    </div>
                    @endif

                    @if($user->address)
                    <div class="row mb-3">
                        <div class="col-md-4 text-md-end">Address:</div>
                        <div class="col-md-8">{{ $user->address }}</div>
                    </div>
                    @endif

                    <!-- Add more profile fields as needed -->

                    <div class="row mt-4">
                        <div class="col-md-8 offset-md-4">
                            <a href="{{ route('patient.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection