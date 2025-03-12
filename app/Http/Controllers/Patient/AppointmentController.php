<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment; // Make sure you have this model

class AppointmentController extends Controller
{
    /**
     * Display a listing of the appointments.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $appointments = Appointment::where('user_id', $user->id)
                        ->orderBy('appointment_date', 'desc')
                        ->get();
                        
        return view('patient.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('patient.appointments.create');
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email',
            'contact' => 'required|string|max:20',
            'gender' => 'required|in:Male,Female',
            'dob' => 'required|date',
            'address' => 'required|string|max:255',
            'ailment' => 'required|string|max:255',
            'appointment_date' => 'required|date|after:today',
        ]);

        $appointment = Appointment::create([
            'user_id' => Auth::id(),
            'fullname' => $request->fullname,
            'email' => $request->email,
            'contact' => $request->contact,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'address' => $request->address,
            'ailment' => $request->ailment,
            'appointment_date' => $request->appointment_date,
            'status' => 'Pending',
        ]);

        return redirect()->route('patient.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display the specified appointment.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Check if the appointment belongs to the authenticated user
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('patient.appointments.show', compact('appointment'));
    }

    /**
     * Cancel the specified appointment.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        
        // Check if the appointment belongs to the authenticated user
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        // Instead of deleting, we can mark it as canceled
        $appointment->status = 'Cancelled';
        $appointment->save();
        
        return redirect()->route('patient.appointments.index')
            ->with('success', 'Appointment cancelled successfully.');
    }
}