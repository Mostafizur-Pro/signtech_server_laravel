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
            'model' => 'required|string',
            'cooling_kw' => 'required|string',
            'cooling_btu' => 'required|integer',
            'cooling_tr' => 'required|string',
            'regular_price' => 'required|string',
            'offer_price' => 'required|string',
            'inverter_type' => 'required|string',
            'category' => 'required|string',

            // Optional numeric/string fields
            'power_input_w' => 'nullable|integer',
            'air_flow_high_cfm' => 'nullable|string',
            'air_flow_medium_cfm' => 'nullable|string',
            'air_flow_low_cfm' => 'nullable|string',
            'refrigerant' => 'nullable|string',
            'size_width_mm' => 'nullable|integer',
            'size_height_mm' => 'nullable|integer',
            'size_depth_mm' => 'nullable|integer',
            'panel_model' => 'nullable|string',
            'panel_type' => 'nullable|string',
            'panel_color' => 'nullable|string',

            // Image validation
            'image_1' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_2' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_3' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Handle image uploads
        if ($request->hasFile('image_1')) {
            $validated['image_1'] = $request->file('image_1')->store('products', 'public');
        }
        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('products', 'public');
        }
        if ($request->hasFile('image_3')) {
            $validated['image_3'] = $request->file('image_3')->store('products', 'public');
        }

        // Save to DB
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
