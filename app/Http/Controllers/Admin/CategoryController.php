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
            'name' => 'required|unique:categories,name',
            'status' => 'required|boolean',
        ]);

        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    // Add other resource methods (show, edit, update, destroy) as needed
}