<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
// --- Get all categories
public function getCategories()
{
    $categories = Category::all();
    return response()->json($categories);
}

// --- Create a new category
public function createCategory(Request $request)
{
    
    $category = Category::create([
        'name' => $request->name,
    ]);

    $category->save();

    return $category;
}

// --- Get a specific category by ID
public function getCategory($categoryId)
{
    $category = Category::findOrFail($categoryId);
    return response()->json($category);
}

// --- Update a category
public function updateCategory(Request $request, $categoryId)
{
    $request->validate([
        'name' => 'required|string', // No uniqueness check
    ]);

    $category = Category::findOrFail($categoryId);
    $category->update([
        'name' => $request->name,
    ]);

    return response()->json($category);
}

// --- Delete a category
public function deleteCategory($categoryId)
{
    $category = Category::findOrFail($categoryId);
    $category->delete();

    return response()->json(['message' => 'Category deleted successfully']);
}
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}