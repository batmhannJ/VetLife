<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestResultController extends Controller
{
    public function index()
    {
        // Return the About Us view
        return view('patient.about.index');
    }
}