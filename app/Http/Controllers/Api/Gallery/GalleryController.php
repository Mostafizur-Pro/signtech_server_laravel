<?php

namespace App\Http\Controllers\Api\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{

    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => Gallery::all(),
        ], 200);
    }
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
    public function destroy($id)
    {
        // Step 1: Find the gallery
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => "Gallery not found"
            ], 404);
        }

        // Step 2: Delete the image file from public/storage
        if ($gallery->image) {
            $imagePath = public_path('storage/' . $gallery->image); // Proper path

            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the file
            } else {
                // \Log::warning("Image file not found at path: $imagePath");
            }
        }

        // Step 3: Delete the gallery from DB
        $gallery->delete();

        // Step 4: Return success response
        return response()->json([
            'success' => true,
            'message' => 'Gallery deleted successfully'
        ]);
    }




    // public function update(Request $request, $id)
    // {
    //     $gallery = Gallery::find($id);

    //     // dd($gallery);


    //     if (!$gallery) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Gallery not found',
    //         ], 404);
    //     }

    //     $validated = $request->validate([
    //         'title'            => 'nullable|string|max:255',
    //         'description'      => 'nullable|string',
    //         'project_name'     => 'nullable|string|max:255',
    //         'project_location' => 'nullable|string|max:255',
    //         'status'           => 'nullable|in:active,inactive,archived',
    //         'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);

    //     dd($validated);

    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
    //         $destinationPath = public_path('gallery_images');

    //         if (!file_exists($destinationPath)) {
    //             mkdir($destinationPath, 0755, true);
    //         }

    //         $image->move($destinationPath, $imageName);
    //         $validated['image'] = url('gallery_images/' . $imageName);
    //     }



    //     $gallery->update($validated);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'User updated successfully',
    //         'data' => $gallery,
    //     ]);
    // }
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => 'Gallery not found',
            ], 404);
        }

        // Validate only sent fields
        $rules = [
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'project_name' => 'sometimes|string|max:255',
            'project_location' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:active,inactive,archived',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048',
        ];
        info($request->all());

        $validated = $request->validate($rules);

        // Handle image upload if image is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('gallery_images', 'public');
            $validated['image'] = $imagePath;

            // Optionally: Delete old image
            if ($gallery->image && file_exists(public_path('storage/' . $gallery->image))) {
                unlink(public_path('storage/' . $gallery->image));
            }
        }

        $gallery->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gallery updated successfully',
            'data' => $gallery,
        ]);
    }


    public function show($id)
    {
        $gallery = Gallery::find($id);

        if (!$gallery) {
            return response()->json([
                'success' => false,
                'message' => 'Gallery not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gallery,
        ]);
    }
}
