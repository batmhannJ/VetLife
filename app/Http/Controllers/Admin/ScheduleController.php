<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        // Validate and save settings logic here
        $validated = $request->validate([
            'setting1' => 'required|string|max:255',
            // Add other validation rules
        ]);
        
        // Save settings to database or configuration
        
        return redirect()->route('admin.schedules.settings')->with('success', 'Settings saved successfully');
    }

}