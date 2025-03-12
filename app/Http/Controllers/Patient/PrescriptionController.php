<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index()
    {
        // If you want to show services instead of prescriptions
        return view('patient.services.index');
    }
}