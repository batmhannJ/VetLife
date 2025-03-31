<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::latest()->get(); // Kunin lahat ng payments, ordered by latest
        return view('admin.payments.index', compact('payments'));
    }

    
    public function setup()
    {
        return view('admin.payments.setup');
    }

    public function store(Request $request)
    {
        $request->validate([
            'paypal_email' => 'required|email',
            'amount' => 'required|numeric|min:1',
        ]);

        Payment::create([
            'paypal_email' => $request->paypal_email,
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.payments.setup')->with('success', 'Payment setup saved successfully.');
    }

}