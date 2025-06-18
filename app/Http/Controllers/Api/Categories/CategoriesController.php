<?php

namespace App\Http\Controllers\Api\Categories;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'image' => 'required|url',
            'path' => 'required|string|max:255|unique:categories,path',
            'position' => 'required|string|max:100',
            'description' => 'required|string',
            'type' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Categories::create($request->all());
        return response()->json(['message' => 'Category created successfully.', 'data' => $category], 201);
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
