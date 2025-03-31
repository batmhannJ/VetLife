@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content Area -->
        <div class="col-md-10 ml-auto">
            <div class="p-3">

                <!-- Payments List Table -->
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">List of Payments</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paypal Email</th>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                    <th>Action</th> <!-- Added for Print Receipt -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->id }}</td>
                                        <td>{{ $payment->paypal_email }}</td>
                                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ $payment->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <button class="btn btn-success btn-sm" onclick="printReceipt({{ $payment->id }}, '{{ $payment->paypal_email }}', {{ $payment->amount }}, '{{ $payment->created_at->format('Y-m-d H:i:s') }}')">
                                                Print Receipt
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No payments found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End Payments List -->

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function printReceipt(id, email, amount, date) {
        let receiptWindow = window.open('', '_blank');
        receiptWindow.document.write(`
            <html>
            <head>
                <title>Receipt #${id}</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        background: #f8f9fa;
                        margin: 0;
                        padding: 20px;
                    }
                    .receipt-container {
                        width: 400px;
                        background: #fff;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        margin: auto;
                        text-align: left;
                    }
                    .receipt-header {
                        text-align: center;
                        font-size: 22px;
                        font-weight: bold;
                        border-bottom: 2px solid #007bff;
                        padding-bottom: 10px;
                        margin-bottom: 15px;
                    }
                    .receipt-details p {
                        font-size: 16px;
                        margin: 5px 0;
                    }
                    .receipt-footer {
                        text-align: center;
                        font-size: 14px;
                        color: #777;
                        margin-top: 15px;
                        border-top: 1px solid #ddd;
                        padding-top: 10px;
                    }
                    .btn-print {
                        display: block;
                        width: 100%;
                        background: #007bff;
                        color: white;
                        padding: 10px;
                        border: none;
                        font-size: 16px;
                        cursor: pointer;
                        border-radius: 5px;
                        margin-top: 10px;
                    }
                    @media print {
                        .btn-print { display: none; }
                        body { background: white; }
                        .receipt-container { box-shadow: none; }
                    }
                </style>
            </head>
            <body>
                <div class="receipt-container">
                    <div class="receipt-header">
                        Payment Receipt
                    </div>
                    <div class="receipt-details">
                        <p><strong>Transaction ID:</strong> ${id}</p>
                        <p><strong>Paypal Email:</strong> ${email}</p>
                        <p><strong>Amount Paid:</strong> ₱${amount.toFixed(2)}</p>
                        <p><strong>Date:</strong> ${date}</p>
                    </div>
                    <div class="receipt-footer">
                        Thank you for your payment!
                    </div>
                    <button class="btn-print" onclick="window.print()">Print Receipt</button>
                </div>
            </body>
            </html>
        `);
        receiptWindow.document.close();
    }
</script>
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