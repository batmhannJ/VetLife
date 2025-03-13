@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Clinic Schedule Settings</h5>
                    <span class="badge badge-light">USER 01</span>
                </div>
                <div class="card-body bg-dark text-white">
                    <form method="POST" action="{{ route('admin.schedules.settings.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Weekly Schedule</h6>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="sunday" name="days[]" value="Sunday">
                                        <label class="custom-control-label" for="sunday">Sunday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="monday" name="days[]" value="Monday" checked>
                                        <label class="custom-control-label" for="monday">Monday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="tuesday" name="days[]" value="Tuesday" checked>
                                        <label class="custom-control-label" for="tuesday">Tuesday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="wednesday" name="days[]" value="Wednesday" checked>
                                        <label class="custom-control-label" for="wednesday">Wednesday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="thursday" name="days[]" value="Thursday" checked>
                                        <label class="custom-control-label" for="thursday">Thursday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="friday" name="days[]" value="Friday" checked>
                                        <label class="custom-control-label" for="friday">Friday</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-2">
                                        <input type="checkbox" class="custom-control-input" id="saturday" name="days[]" value="Saturday">
                                        <label class="custom-control-label" for="saturday">Saturday</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Morning Time Schedule</h6>
                                <div class="form-group row">
                                    <div class="col-5">
                                        <input type="time" class="form-control" name="morning_start" value="08:00">
                                    </div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <input type="time" class="form-control" name="morning_end" value="11:00">
                                    </div>
                                </div>
                                
                                <h6 class="mb-3 mt-4">Afternoon Time Schedule</h6>
                                <div class="form-group row">
                                    <div class="col-5">
                                        <input type="time" class="form-control" name="afternoon_start" value="01:00">
                                    </div>
                                    <div class="col-2 text-center d-flex align-items-center justify-content-center">
                                        <span>to</span>
                                    </div>
                                    <div class="col-5">
                                        <input type="time" class="form-control" name="afternoon_end" value="04:00">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        overflow: hidden;
        border: none;
    }
    
    .card-header {
        padding: 15px 20px;
        background-color: #1e2a38 !important;
        border-bottom: 1px solid #2a3a4a;
    }
    
    .card-body {
        background-color: #1e2a38 !important;
        padding: 20px;
    }
    
    .form-control {
        border-radius: 4px;
        background-color: #2a3a4a;
        border: 1px solid #3a4a5a;
        color: #fff;
        height: 38px;
    }
    
    .form-control:focus {
        background-color: #2a3a4a;
        color: #fff;
        border-color: #4a90e2;
        box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
    }
    
    .btn-primary {
        background-color: #3498db;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        font-weight: 500;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
    }
    
    .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #3498db;
        border-color: #3498db;
    }
    
    .custom-checkbox .custom-control-label::before {
        border-radius: 3px;
    }
    
    h6 {
        font-weight: 500;
        color: #eee;
        margin-bottom: 15px;
    }
    
    .badge-light {
        background-color: #f8f9fa;
        color: #212529;
        font-weight: 500;
    }
    
    /* Match the dark sidebar style from screenshot */
    body {
        background-color: #1e2a38;
    }
    
    .custom-control-label {
        color: #eee;
    }
    
    /* Make sure checkboxes are visible and match the screenshot */
    .custom-control-input:checked ~ .custom-control-label::after {
        background-color: white;
    }
</style>
@endsection