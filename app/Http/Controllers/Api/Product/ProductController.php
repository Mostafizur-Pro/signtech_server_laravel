<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);

        return response()->json($product, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string',
            'price' => 'required|numeric',
            'regular_price' => 'nullable|numeric',
            'size' => 'nullable|string|max:50',
            'refrigerant' => 'nullable|string|max:100',
            'general' => 'nullable|string|max:255',
            'capacity' => 'nullable|string|max:50',
            'power' => 'nullable|string|max:100',
            'model' => 'nullable|string|max:100',
            'unit' => 'nullable|string|max:50',
            'type' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        return response()->json([
            'message' => 'Product created successfully',
            'data' => $product,
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);

        $product->update($request->all());
        return response()->json($product, 200);
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Product not found'], 404);

        $product->delete();
        return response()->json(['message' => 'Product deleted'], 200);
    }
}
