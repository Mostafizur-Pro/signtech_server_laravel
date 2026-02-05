@extends('layouts.app')

@section('page-title', 'Change Password')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Change Password</h2>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('change-password.update') }}" method="POST">
        @csrf

        <!-- Current Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Current Password</label>
            <input type="password" name="current_password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                required>
            @error('current_password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">New Password</label>
            <input type="password" name="new_password"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                required>
            @error('new_password')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm New Password -->
        <div class="mb-4">
            <label class="block mb-1 font-medium">Confirm New Password</label>
            <input type="password" name="new_password_confirmation"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                required>
        </div>

        <button type="submit"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Update Password</button>
    </form>
</div>
@endsection