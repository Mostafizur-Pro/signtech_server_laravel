<?php

namespace App\Http\Controllers\Api\ContactMessage;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Contact Message retrieved successfully',
            'data' => ContactMessage::all(),
        ], 200);
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save to DB
        $ContactMessage = ContactMessage::create([
            'first_name' => $validated['firstName'],
            'last_name' => $validated['lastName'],
            'number' => $validated['number'],
            'email' => $validated['email'],
            'message' => $validated['message'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully!',
            'data'    => $ContactMessage,
        ], 201);
    }
    public function destroy($id)
    {
        $user = ContactMessage::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => "Contact Message not found"
            ], 404);
        }
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'Contact Message deleted successfully'
        ]);
    }
}
