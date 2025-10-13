@extends('layouts.app')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
        
        <!-- Profile Image -->
        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center text-4xl font-bold text-gray-600">
            {{ strtoupper(substr(Session::get('user_name') ?? 'U', 0, 1)) }}
        </div>

        <!-- User Information -->
        <div class="flex-1">
            <h2 class="text-2xl font-semibold text-gray-800 mb-2">
                {{ Session::get('user_name') }}
            </h2>

            <p class="text-gray-600 mb-1"><strong>Email:</strong> {{ Session::get('user_email') ?? 'Not Provided' }}</p>
            <p class="text-gray-600 mb-1"><strong>Phone:</strong> {{ Session::get('user_phone') ?? 'Not Provided' }}</p>
            <p class="text-gray-600 mb-1"><strong>Role:</strong> {{ Session::get('user_role') ?? 'User' }}</p>
            <p class="text-gray-600 mt-3 text-sm">
                Member since {{ Session::get('user_created_at') ?? 'N/A' }}
            </p>

            <!-- Edit Profile Button -->
            <div class="mt-5">
                <a
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    ✏️ Edit Profile
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
