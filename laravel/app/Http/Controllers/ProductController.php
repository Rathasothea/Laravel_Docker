<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // --- Get all products
    public function getProducts()
    {
        $products = Product::with('category')->get(); // Eager load the category relationship
        return response()->json($products);
    }

    // --- Create a new product
    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Ensure 'images' is an array
        ]);

        $product = Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'pricing' => $request->pricing,
            'description' => $request->description,
            'images' => $request->images, // Automatically cast to JSONB
        ]);

        return $product;
    }

    // --- Get a specific product by ID
    public function getProduct($productId)
    {
        $product = Product::with('category')->findOrFail($productId); // Eager load the category
        return response()->json($product);
    }

    // --- Update a product
    public function updateProduct(Request $request, $productId)
    {
        $request->validate([
            'name' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'pricing' => 'sometimes|numeric',
            'description' => 'nullable|string',
            'images' => 'nullable|array', // Ensure 'images' is an array
        ]);

        $product = Product::findOrFail($productId);
        $product->update($request->only(['name', 'category_id', 'pricing', 'description', 'images']));

        return response()->json($product);
    }

    // --- Delete a product
    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}