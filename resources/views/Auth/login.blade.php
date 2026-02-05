<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

 
</head>
<body class="bg-gray-100 font-sans">


<div class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">

        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('image/main_logo.png') }}" alt="Logo" class="h-16 w-auto">
        </div>

        <!-- Title -->
        <h1 class="text-3xl font-bold mb-6 text-center text-gray-800">Login</h1>

        <!-- Display Errors -->
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email" required>
            </div>

            <div>
                <label class="block mb-1 font-medium text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-700 text-sm">Remember Me</label>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-semibold p-2 rounded hover:bg-blue-700 transition duration-200">
                Login
            </button>

            <div class="text-center mt-4 text-sm">
                <a href="#" class="text-blue-600 hover:underline">Forgot Password?</a>
            </div>

            <div class="text-center mt-2 text-sm">
                Don't have an account? 
                <a href="{{ url('/register') }}" class="text-blue-600 hover:underline">Register</a>
            </div>
        </form>
    </div>
</div>


</body>
</html>