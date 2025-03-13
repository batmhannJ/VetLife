<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GatewayController extends Controller
{
    public function index()
    {
        // Your gateway display logic here
        return view('admin.gateway.index');
    }
    
    // Your other methods...
}