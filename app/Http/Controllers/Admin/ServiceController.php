<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(5);
        $categories = Category::all();
        
        return view('admin.services.index', compact('services', 'categories'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('admin.services.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'for' => 'required|string|max:255',
        ]);
        
        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'for' => $request->for,
        ]);
        
        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully');
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