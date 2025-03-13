@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-10 ml-auto">
            <div class="p-3">
                <!-- Card with Payment Form -->
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-light p-2 mr-3">
                                <i class="fas fa-credit-card text-dark"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Setup Payment Method</h5>
                                <small class="text-muted">Setup Payment Method</small>
                            </div>
                        </div>
                        <a href="#" class="text-decoration-none">Dashboard</a>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label for="paypalEmail" class="col-sm-3 col-form-label text-right">Paypal Business Email</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" id="paypalEmail" value="email@gmail.com">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="amount" class="col-sm-3 col-form-label text-right">Amount</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="amount" value="25">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="col-sm-9 offset-sm-3">
                                    <button type="button" class="btn btn-danger mr-2">Reset</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
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
    
    .btn-primary {
        background-color: #007bff;
        border: none;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border: none;
    }
    
    .rounded-circle {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection