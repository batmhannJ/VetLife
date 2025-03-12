<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserRole
{
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        if ($role == 'admin' && !Auth::user()->roles->contains('title', 'Admin')) {
            return redirect('patient/dashboard');
        }

        if ($role == 'patient' && Auth::user()->roles->contains('title', 'Admin')) {
            return redirect('admin');
        }

        return $next($request);
    }
}