<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class DoctorController extends Controller
{
    public function index()
    {
        
        $doctors = Doctor::latest()->paginate(10);
        
        return view('admin.doctors.index', compact('doctors'));

    }
    
    public function create()
    {
        return view('admin.doctors.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:doctors,email',
            'designation' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'specialist' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'service_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $doctor = Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'degree' => $request->degree,
            'department' => $request->department,
            'specialist' => $request->specialist,
            'experience' => $request->experience,
            'service_place' => $request->service_place,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        if ($request->hasFile('photo')) {
            try {
                $doctor->addMediaFromRequest('photo')
                    ->toMediaCollection('photos');
            } catch (FileDoesNotExist $e) {
                return redirect()->back()
                    ->withErrors(['photo' => 'File does not exist']);
            } catch (FileIsTooBig $e) {
                return redirect()->back()
                    ->withErrors(['photo' => 'File is too big']);
            }
        }
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor created successfully');
    }
    
    public function edit(Doctor $doctor)
    {
        return view('admin.doctors.edit', compact('doctor'));
    }
    
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:doctors,email,' . $doctor->id,
            'designation' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'specialist' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'service_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'degree' => $request->degree,
            'department' => $request->department,
            'specialist' => $request->specialist,
            'experience' => $request->experience,
            'service_place' => $request->service_place,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        
        if ($request->hasFile('photo')) {
            try {
                // Clear previous photos first
                $doctor->clearMediaCollection('photos');
                
                // Add the new photo
                $doctor->addMediaFromRequest('photo')
                    ->toMediaCollection('photos');
            } catch (FileDoesNotExist $e) {
                return redirect()->back()
                    ->withErrors(['photo' => 'File does not exist']);
            } catch (FileIsTooBig $e) {
                return redirect()->back()
                    ->withErrors(['photo' => 'File is too big']);
            }
        }
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor updated successfully');
    }
    
    public function destroy(Doctor $doctor)
    {
        // Clear media files
        $doctor->clearMediaCollection('photos');
        
        // Delete the doctor
        $doctor->delete();
        
        return redirect()->route('admin.doctors.index')
            ->with('success', 'Doctor deleted successfully');
    }
}