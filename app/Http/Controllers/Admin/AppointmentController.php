<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['doctor', 'patient'])
            ->orderBy('appointment_date', 'desc');
    
        $appointments = $query->paginate(10);
    
        return view('admin.appointments.index', compact('appointments'));
    }
    public function requests()
    {

        $requests = Appointment::with(['patient', 'doctor'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('admin.appointments.requests', compact('requests'));
    }

    public function getAppointmentCounts()
    {
        try {
            \Log::info('getAppointmentCounts method called');

            $appointments = DB::table('appointments')
                ->select(DB::raw('DATE(appointment_date) as date'), DB::raw('COUNT(*) as count'))
                ->groupBy('date')
                ->get();
            
            // Convert to the format needed by the calendar
            $appointmentCounts = [];
            foreach ($appointments as $appointment) {
                $appointmentCounts[$appointment->date] = (int)$appointment->count;
            }
            
            return response()->json($appointmentCounts);
        } catch (\Exception $e) {
            \Log::error('Error in getAppointmentCounts: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return redirect()->route('admin.appointments.index')->with('error', 'Appointment not found.');
        }

        return view('admin.appointments.show', compact('appointment'));
    }

public function create(Request $request)
{
    $date = $request->query('date');
    return view('admin.appointments.create', compact('date'));
}

public function update(Request $request, Appointment $appointment)
{
    $request->validate([
        'fullname' => 'required',
        'ailment' => 'required',
        'appointment_date' => 'required|date',
        'status' => 'required|in:Pending,Approved,Completed,Cancelled',
    ]);

    $appointment->update($request->all());

    return redirect()->route('admin.appointments.index')->with('success', 'Appointment updated successfully');
}

public function edit(Appointment $appointment)
{
    return view('admin.appointments.edit', compact('appointment'));
}

public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();
    return redirect()->route('admin.appointments.index')->with('success', 'Appointment deleted successfully');
}

public function getAvailableDays()
{
    $schedules = DB::table('schedules')->pluck('day')->toArray(); // Kunin ang lahat ng available days
    $availableDays = collect($schedules)->flatten()->unique(); // Flatten and remove duplicates
    return response()->json($availableDays);
}

}