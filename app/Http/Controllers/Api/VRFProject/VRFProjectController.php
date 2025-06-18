<?php

namespace App\Http\Controllers\Api\VRFProject;

use App\Http\Controllers\Controller;
use App\Models\VRF_Project;
use Illuminate\Http\Request;

class VRFProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => VRF_Project::all(),
        ], 200);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'brand' => 'nullable|string|max:255',
            'capacity' => 'nullable|string|max:255',
            'equipment_list' => 'nullable|array',
            'description' => 'nullable|string',
            'indoor_type' => 'nullable|string|max:255',
            'outdoor_type' => 'nullable|string|max:255',
            'drawings' => 'nullable|array',
            'remarks' => 'nullable|string',
            'start_date' => 'nullable|date',
            'completed_date' => 'nullable|date',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:active,pending,ongoing,completed,cancelled',
        ]);

        $project = new VRF_Project();

        $project->project_name = $validated['project_name'];
        $project->client_name = $validated['client_name'];
        $project->location = $validated['location'] ?? null;
        $project->brand = $validated['brand'] ?? null;
        $project->capacity = $validated['capacity'] ?? null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('project_images', 'public');
        }

        // Encode arrays to JSON before saving
        $project->equipment_list = isset($validated['equipment_list']) ? json_encode($validated['equipment_list']) : null;
        $project->drawings = isset($validated['drawings']) ? json_encode($validated['drawings']) : null;

        $project->description = $validated['description'] ?? null;
        $project->indoor_type = $validated['indoor_type'] ?? null;
        $project->outdoor_type = $validated['outdoor_type'] ?? null;
        $project->remarks = $validated['remarks'] ?? null;
        $project->start_date = $validated['start_date'] ?? null;
        $project->completed_date = $validated['completed_date'] ?? null;
        $project->status = $validated['status'];
        $project->image = $imagePath;

        $project->save();

        return response()->json(['message' => 'Project created successfully', 'data' => $project], 201);
    }




    public function destroy($id)
    {
        $user = VRF_Project::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Gallery not found"
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Gallery deleted successfully'
        ]);
    }
}
