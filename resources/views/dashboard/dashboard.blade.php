@extends('layouts.app')

@section('content')

<div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-lg text-center">

        <!-- Welcome Message -->
        <h1 class="text-3xl font-bold mb-4 text-gray-800">
            
            NAME
        </h1>

        <!-- User Details -->
        <div class="mb-6">
            DATA
            
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-600 text-white font-semibold px-6 py-2 rounded hover:bg-red-700 transition duration-200">
                Logout
            </button>
        </form>

    </div>
</div>

@endsection
