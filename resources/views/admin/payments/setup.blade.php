@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-wallet"></i> Setup Payment Method</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.payments.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="paypal_email" class="form-label">Paypal Business Email</label>
                            <input type="email" class="form-control" id="paypal_email" name="paypal_email" value="{{ old('paypal_email') }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="reset" class="btn btn-outline-danger">Reset</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
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