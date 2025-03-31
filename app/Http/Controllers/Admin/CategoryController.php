<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Make sure you have this model

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'animal_type' => 'required|string|max:255',
    ]);

    Category::create([
        'animal_type' => $request->animal_type,
    ]);

    return redirect()->route('admin.categories.index')->with('status', 'Category added successfully!');
}

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'animal_type' => 'required|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'animal_type' => $request->animal_type,
        ]);
    
        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully!');
    }
    
}