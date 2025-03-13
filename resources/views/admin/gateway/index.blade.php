@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-10 ml-auto">
            <div class="p-3">
                <!-- Card with Gateway Setup Form -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 mr-3">
                                <i class="fas fa-sms text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Gateway Setup</h5>
                                <small class="text-muted">Gateway Setup</small>
                            </div>
                        </div>
                        <a href="#" class="btn btn-sm btn-light">Dashboard</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Provider</th>
                                        <th>User Name</th>
                                        <th>Password</th>
                                        <th>Sender</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="status1" checked>
                                            </div>
                                        </td>
                                        <td>Nexmo</td>
                                        <td>admin</td>
                                        <td>*****</td>
                                        <td>GLOW-VETLIFE</td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                        </td>
                                    </tr>
                                    <!-- Additional rows would be populated from database -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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