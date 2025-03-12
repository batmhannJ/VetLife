<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Or your specific patient model

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $user = Auth::user();
        return view('patient.profile.show', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user = Auth::user();
        return view('patient.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'contact' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            // Add other validation rules as needed
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            // Update other fields as needed
        ]);

        return redirect()->route('patient.profile.show')
            ->with('success', 'Profile updated successfully.');
    }
}