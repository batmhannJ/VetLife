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

    if ($request->has('animal_type') && !empty($request->animal_type)) {
        $query->where('animal_type', $request->animal_type);
    }

    $services = $query->paginate(10);

    return view('admin.services.index', compact('services'));
}

    
public function create()
{
    return view('admin.services.create');
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
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'for' => 'required|string|max:255',
        ]);
        
        $service->update([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'for' => $request->for,
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