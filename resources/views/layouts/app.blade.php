

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    
</head>
<body class="bg-gray-100 font-sans">

    <!-- Sidebar + Content Wrapper -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col justify-between">
            <div>
                <!-- Brand -->
                <div class="p-5 text-2xl font-bold border-b border-gray-700">
                    <a href="/dashboard" class="hover:text-gray-300">My Dashboard</a>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-6 space-y-2">
                    <a href="/dashboard" class="flex items-center px-5 py-2 hover:bg-gray-700 rounded transition">
                        <span class="ml-2">🏠 Dashboard</span>
                    </a>

                    <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-700 rounded transition">
                        <span class="ml-2">👤 Profile</span>
                    </a>

                    <a href="/settings" class="flex items-center px-5 py-2 hover:bg-gray-700 rounded transition">
                        <span class="ml-2">⚙️ Settings</span>
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="px-5">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center py-2 hover:bg-red-600 rounded transition">
                            <span class="ml-2">🚪 Logout</span>
                        </button>
                    </form>
                </nav>
            </div>

            <!-- Footer -->
            <div class="p-4 border-t border-gray-700 text-sm text-gray-400 text-center">
                &copy; {{ date('Y') }} My App
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">

            <!-- Top Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <form class="hidden md:block">
                        <input type="text" placeholder="Search..." class="border rounded px-3 py-1 focus:outline-none focus:ring focus:ring-blue-200">
                    </form>

                    <!-- User -->
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700">
                            {{ strtoupper(substr(Session::get('user_name') ?? 'U', 0, 1)) }}
                        </div>
                        <span class="text-gray-700 font-medium">{{ Session::get('user_name') }}</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>
