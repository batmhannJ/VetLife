<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category; // Make sure you have this model
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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
            'animal_type' => 'required|string|max:255',
            'description' => 'string',
        ]);
    
        $category = Category::findOrFail($id);
        $category->update([
            'animal_type' => $request->animal_type,
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin.categories.index')->with('status', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return back();
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }
    
}