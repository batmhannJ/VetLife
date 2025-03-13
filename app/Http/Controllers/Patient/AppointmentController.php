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
            'appointment_time' => 'required|date_format:H:i', // Validate time
            'status' => 'required|string|max:255',
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
            'appointment_time' => $request->appointment_time,
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
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('patient.appointments.index')->with('error', 'Appointment not found.');
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
        $appointment = Appointment::find($id);
    
        if (!$appointment) {
            return redirect()->route('patient.appointments.index')->with('error', 'Appointment not found.');
        }
    
        $appointment->delete();
    
        return redirect()->route('patient.appointments.index')->with('success', 'Appointment deleted successfully.');
    }
    public function getAppointmentCounts()
    {
        // Get the current month start and end dates
        $startDate = now()->startOfMonth()->subMonth();
        $endDate = now()->endOfMonth()->addMonth();

        // Query appointments grouped by date
        $appointments = DB::table('appointments')
            ->select(DB::raw('DATE(appointment_date) as date'), DB::raw('COUNT(*) as count'))
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(appointment_date)'))
            ->get();

        // Format the results as a keyed array
        $results = [];
        foreach ($appointments as $appointment) {
            $results[$appointment->date] = $appointment->count;
        }

        return response()->json($results);
    }
}