@extends('layouts.app')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')

@if(session('success'))
<div class="max-w-5xl mx-auto mb-4">
    <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
</div>
@endif

<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">

        <!-- Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 h-32"></div>

        <!-- Profile Section -->
        <div class="px-8 pb-8">
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 -mt-16">

                <!-- Avatar + Name -->
                <div class="flex items-center gap-5">
                    <div class="w-28 h-28 rounded-full bg-white p-1 shadow-md">
                        <div class="w-full h-full rounded-full bg-blue-100 flex items-center justify-center text-4xl font-bold text-blue-600">
                            {{ strtoupper(substr(Session::get('user_name') ?? 'U', 0, 1)) }}
                        </div>
                    </div>

                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">
                            {{ Session::get('user_name') }}
                        </h2>
                        <p class="text-gray-500 text-sm">
                            {{ Session::get('user_role') ?? 'User' }}
                        </p>
                    </div>
                </div>

                <!-- Edit Button -->
                <div>
                    <button
                        onclick="openModal()"
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                        ✏️ Edit Profile
                    </button>
                </div>
            </div>

            <!-- Info Grid -->
            <div class="grid md:grid-cols-2 gap-6 mt-10">

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-sm text-gray-500 mb-1">Email</p>
                    <p class="text-gray-800 font-medium">
                        {{ Session::get('user_email') ?? 'Not Provided' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-sm text-gray-500 mb-1">Phone</p>
                    <p class="text-gray-800 font-medium">
                        {{ Session::get('user_number') ?? 'Not Provided' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-sm text-gray-500 mb-1">Role</p>
                    <p class="text-gray-800 font-medium">
                        {{ Session::get('user_role') ?? 'User' }}
                    </p>
                </div>

                <div class="bg-gray-50 rounded-xl p-5">
                    <p class="text-sm text-gray-500 mb-1">Member Since</p>
                    <p class="text-gray-800 font-medium">
                        {{ Session::get('user_created_at') ?? 'N/A' }}
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editModal"
    class="fixed inset-0 bg-black bg-opacity-40 hidden items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-xl shadow-lg p-6 relative">
        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            ✕
        </button>

        <h3 class="text-xl font-semibold text-gray-800 mb-6">
            Edit Profile
        </h3>

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Name</label>
                    <input type="text"
                        name="name"
                        value="{{ Session::get('user_name') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Email</label>
                    <input type="email"
                        name="email"
                        value="{{ Session::get('user_email') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm text-gray-600 mb-1">Phone</label>
                    <input type="text"
                        name="phone"
                        value="{{ Session::get('user_number') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <button type="button"
                    onclick="closeModal()"
                    class="px-4 py-2 rounded-lg border text-gray-600 hover:bg-gray-100">
                    Cancel
                </button>

                <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Script -->
<script>
    function openModal() {
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('editModal').classList.remove('flex');
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

@endsection