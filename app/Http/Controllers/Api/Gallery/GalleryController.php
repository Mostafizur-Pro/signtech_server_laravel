<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'description'      => 'nullable|string',
            'project_name'     => 'nullable|string|max:255',
            'project_location' => 'nullable|string|max:255',
            'status'           => 'required|in:active,inactive,archived',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // dd($request);

        // Upload image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gallery_images', 'public');
        }

        $gallery = Gallery::create([
            'title'            => $request->title,
            'description'      => $request->description,
            'project_name'     => $request->project_name,
            'project_location' => $request->project_location,
            'status'           => $request->status,
            'image'            => $imagePath ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Gallery added successfully',
            'data'    => $gallery,
        ], 201);
    }
}
