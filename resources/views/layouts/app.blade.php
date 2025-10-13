<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const openBtn = document.getElementById('open-sidebar');
      const closeBtn = document.getElementById('close-sidebar');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');

      // Open sidebar on mobile
      openBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      });

      // Close sidebar on mobile
      closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });

      overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });
    });
  </script>
</head>

<body class="bg-gray-100 font-sans">

  <div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:relative z-30 w-64 bg-gray-800 text-white flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
      <div>
        <!-- Brand -->
        <div class="p-5 text-2xl font-bold border-b border-gray-700 flex justify-between items-center">
          <a href="/dashboard" class="hover:text-gray-300">My Dashboard</a>
          <button id="close-sidebar" class="md:hidden text-gray-400 hover:text-white text-xl">
            ✖
          </button>
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

    <!-- Sidebar Overlay (Mobile) -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-40 hidden md:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">

      <!-- Top Navbar -->
      <header class="bg-white shadow px-4 md:px-6 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <!-- Mobile Menu Button -->
          <button id="open-sidebar" class="md:hidden text-gray-700 text-2xl hover:text-gray-900">
            ☰
          </button>
          <h1 class="text-lg md:text-xl font-semibold text-gray-700">@yield('page-title', 'Dashboard')</h1>
        </div>

        <div class="flex items-center space-x-4">
          <!-- Search (Hidden on mobile) -->
          <form class="hidden md:block">
            <input type="text" placeholder="Search..." class="border rounded px-3 py-1 focus:outline-none focus:ring focus:ring-blue-200">
          </form>

          <!-- User Info -->
          <div class="flex items-center space-x-2">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 uppercase">
              {{ strtoupper(substr(Session::get('user_name') ?? 'U', 0, 1)) }}
            </div>
            <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[100px]">
              {{ Session::get('user_name') }}
            </span>
          </div>
        </div>
      </header>

      <!-- Page Content -->
      <main class="flex-1 overflow-y-auto p-4 md:p-6">
        @yield('content')
      </main>
    </div>
  </div>

</body>
</html>
