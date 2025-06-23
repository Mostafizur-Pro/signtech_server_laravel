<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;


class CategoriesController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => Categories::all(),
        ], 200);
    }
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'path' => 'required|string|max:255',
            'position' => 'nullable|integer',
            'description' => 'nullable|string',
            'type' => 'required|string|max:100',
            'status' => 'required|in:active,inactive,archived',
        ]);



        // Store the uploaded image

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }


        // dd($imagePath);

        // Save to database
        $category = Categories::create([
            'title' => $validated['title'],
            'image' => $imagePath ?? null,
            'path' => $validated['path'],
            'position' => $validated['position'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'status' => $validated['status'],
        ]);

        return response()->json([
            'message' => 'Category created successfully.',
            'category' => $category
        ], 201);
    }

    public function destroy($id)
    {
        $user = Categories::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Categories not found"
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Categories deleted successfully'
        ]);
    }
}
