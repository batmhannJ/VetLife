@extends('layouts.patient')

@section('title', 'Our Services')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2>Our Services</h2>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Available Services
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Add your services here -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">General Consultation</h5>
                            <p class="card-text">General medical checkup and consultation with our doctors.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Laboratory Services</h5>
                            <p class="card-text">Complete range of diagnostic laboratory tests.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Vaccination</h5>
                            <p class="card-text">Routine and specialized vaccination services.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Add more services as needed -->
            </div>
        </div>
    </div>
</div>
@endsection