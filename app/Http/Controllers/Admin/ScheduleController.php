<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule; 
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.schedules.index');
    }

    /**
     * Show the form for creating a new schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    /**
     * Store a newly created schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation and storage logic here
        
        return redirect()->route('admin.schedules.index')->with('success', 'Schedule created successfully');
    }

    /**
     * Display the settings page for schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        // Your schedule settings logic here
        return view('admin.schedules.settings');
    }
   
    public function saveSettings(Request $request)
{
    \Log::info('saveSettings function triggered.');

    // Validate input fields
    $validated = $request->validate([
        'day' => 'required|array|min:1', 
        'day.*' => 'string',
        'morning_start' => 'required|date_format:h:i A',
        'morning_end' => 'required|date_format:h:i A|after:morning_start',
        'afternoon_start' => 'required|date_format:h:i A',
        'afternoon_end' => 'required|date_format:h:i A|after:afternoon_start',
    ]);

    \Log::info('Request validated successfully.', $validated);

    // Kunin ang naka-login na admin
    \Log::info('Session ID Before:', ['id' => session()->getId()]);
    $admin = Auth::guard('web')->user();
    \Log::info('Admin Data:', ['user' => $admin]);
    \Log::info('Session ID After:', ['id' => session()->getId()]);
    
    if (!$admin) {
        \Log::error('No admin is logged in.');
        return redirect()->back()->with('error', 'You must be logged in as an admin.');
    }

    \Log::info("Logged in admin ID: " . $admin->id); // ✅ Dapat integer lang ito

    // Hanapin kung may existing schedule ang admin na ito
    $schedule = Schedule::where('admin_id', $admin->id)->first();

    if (!$schedule) {
        \Log::info('No existing schedule found, creating a new one.');
        $schedule = new Schedule();
        $schedule->admin_id = $admin->id; // ✅ Dapat `id` lang
    }

    // I-save ang mga bagong settings
    $schedule->day = json_encode($request->day);
    $schedule->morning_start = Carbon::createFromFormat('h:i A', $request->morning_start)->format('H:i:s');
    $schedule->morning_end = Carbon::createFromFormat('h:i A', $request->morning_end)->format('H:i:s');
    $schedule->afternoon_start = Carbon::createFromFormat('h:i A', $request->afternoon_start)->format('H:i:s');
    $schedule->afternoon_end = Carbon::createFromFormat('h:i A', $request->afternoon_end)->format('H:i:s');
    
    if ($schedule->save()) {
        \Log::info('Schedule saved successfully.', $schedule->toArray());
        return redirect()->route('admin.schedules.settings')->with('success', 'Settings saved successfully.');
    } else {
        \Log::error('Failed to save schedule.');
        return redirect()->back()->with('error', 'Failed to save schedule.');
    }
}

}