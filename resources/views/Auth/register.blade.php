@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('image/main_logo.png') }}" alt="Logo" class="h-16 w-auto">
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Register</h1>

        <!-- Display Errors -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Registration Form -->
        <form action="{{ url('/register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your full name" required>
            </div>

            <!-- Number -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Phone Number</label>
                <input type="text" name="number" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your phone number" required>
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>

            <!-- Password -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
            </div>

            <!-- Image URL -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Image URL</label>
                <input type="url" name="image" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter profile image URL">
            </div>

            <!-- Status -->
            <div>
                <label class="block mb-1 font-medium text-gray-700">Status</label>
                <select name="status" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="active" selected>Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-green-600 text-white font-semibold p-2 rounded hover:bg-green-700 transition duration-200">
                Register
            </button>

            <!-- Login Link -->
            <div class="text-center mt-4 text-sm">
                Already have an account? 
                <a href="{{ url('/') }}" class="text-blue-600 hover:underline">Login</a>
            </div>

        </form>
    </div>
</div>

@endsection
