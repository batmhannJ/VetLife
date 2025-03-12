<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Your code here
        return view('admin.appointments.index');
    }

    public function requests()
    {
        // Your code here
        return view('admin.appointments.requests');
    }
}