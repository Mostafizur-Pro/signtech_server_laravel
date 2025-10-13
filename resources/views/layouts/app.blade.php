<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Dashboard')</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const openBtn = document.getElementById('open-sidebar');
      const closeBtn = document.getElementById('close-sidebar');
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebar-overlay');
      const dropdownBtn = document.getElementById('settings-btn');
      const dropdownMenu = document.getElementById('settings-menu');

      // Mobile sidebar toggle
      openBtn.addEventListener('click', () => {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      });

      closeBtn.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });

      overlay.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      });

      // User dropdown toggle
      dropdownBtn.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', function(e) {
        if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
    });
  </script>
</head>
<body class="bg-gray-100 font-sans">

  <div class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:relative z-30 w-64 bg-gray-800 text-white flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out" x-data="{ settingsOpen: false }">
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
          <a href="/dashboard" class="flex items-center px-5 py-2 hover:bg-gray-700 rounded transition {{ Request::is('dashboard') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">🏠 Dashboard</span>
          </a>

          <a href="/profile" class="flex items-center px-5 py-2 hover:bg-gray-700 rounded transition {{ Request::is('profile') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">👤 Profile</span>
          </a>

          <!-- Settings Dropdown -->
          <div x-data="{ open: false }" class="px-5">
            <button @click="open = !open" class="w-full flex items-center justify-between py-2 hover:bg-gray-700 rounded transition focus:outline-none">
              <span>⚙️ Settings</span>
              <span x-text="open ? '▾' : '▸'"></span>
            </button>
            <div x-show="open" class="mt-1 ml-4 space-y-1" x-cloak>
              <a href="/basic" class="block px-3 py-1 hover:bg-gray-700 rounded transition">📄 Basic</a>
              <a href="/qr-generator" class="block px-3 py-1 hover:bg-gray-700 rounded transition">📁 QR Generator</a>
            </div>
          </div>

          <form action="{{ route('logout') }}" method="POST" class="px-5 mt-2">
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

          <!-- User Info + Dropdown -->
          <div class="relative">
            <button id="settings-btn" class="flex items-center space-x-2 focus:outline-none">
              <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center text-gray-700 uppercase">
                {{ strtoupper(substr(Session::get('user_name') ?? 'U', 0, 1)) }}
              </div>
              <span class="hidden sm:block text-gray-700 font-medium truncate max-w-[100px]">
                {{ Session::get('user_name') }}
              </span>
            </button>

            <!-- Dropdown Menu -->
            <div id="settings-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border hidden z-50">
              <a href="/profile" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
              <a href="/settings" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
              <div class="border-t mt-1">
                <a href="/basic" class="block px-4 py-2 hover:bg-gray-100">Basic</a>
                <a href="/qr-generator" class="block px-4 py-2 hover:bg-gray-100">QR Generator</a>
              </div>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">Logout</button>
              </form>
            </div>
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
