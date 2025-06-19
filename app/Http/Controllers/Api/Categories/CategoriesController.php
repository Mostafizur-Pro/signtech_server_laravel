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
        $request->validate([
            'title' => 'required|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'path' => 'required|string',
            'position' => 'required|string',
            'description' => 'required|string',
            'type' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category = Categories::create([
            'title' => $request->title,
            'image' => $imagePath,
            'path' => $request->path,
            'position' => $request->position,
            'description' => $request->description,
            'type' => $request->type,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Categories added successfully',
            'data'    => $category,
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
