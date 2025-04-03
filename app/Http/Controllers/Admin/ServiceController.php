<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index(Request $request)
{
    $query = Service::query();
    
    // Filter by animal type if specified
    if ($request->filled('animal_type')) {
        $query->where('for', $request->animal_type);
    }
    
    $services = $query->paginate(5);
    
    // Get unique animal types from Categories table
    $animalTypes = Category::select('animal_type')->distinct()->get();
    
    return view('admin.services.index', compact('services', 'animalTypes'));
}   

    
public function create()
{
    // Get unique animal types from Categories table
    $animalTypes = Category::select('animal_type')->distinct()->get();
    
    return view('admin.services.create', compact('animalTypes'));
}

public function show($id)
{
    $service = Service::findOrFail($id);
    return view('admin.services.show', compact('service'));
}

public function store(Request $request)
{
    // Validate Input
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'animal_type' => 'required|string|in:Dog,Cat,Bird',
        'active' => 'required|boolean',
    ]);

    // Save to Database
    Service::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'animal_type' => $request->animal_type,
        'active' => $request->active,
    ]);

    // Redirect with Success Message
    return redirect()->route('admin.services.index')->with('success', 'Service added successfully!');
}
    
    public function edit(Service $service)
    {
        $categories = Category::all();
        return view('admin.services.edit', compact('service', 'categories'));
    }
    
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'animal_type' => 'required|string|max:255',
            'active' => 'required',
            'updated_at' => ''
        ]);
        
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'animal_type' => $request->animal_type,
            'active' => $request->active,
            'updated_at' => now(),
        ]);
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }
    
    public function destroy(Service $service)
    {
        $service->delete();
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully');
    }
}