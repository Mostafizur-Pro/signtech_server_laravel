@extends('layouts.app')

@section('page-title', 'Manage Users')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">User Management</h2>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 px-4 py-2 mb-4 rounded">
        {{ session('success') }}
    </div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">#</th>
                <th class="border px-4 py-2 text-left">Name</th>
                <th class="border px-4 py-2 text-left">Email</th>
                <th class="border px-4 py-2 text-left">Role</th>
                <th class="border px-4 py-2 text-left">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $user)
            <tr class="{{ $key % 2 == 0 ? 'bg-gray-50' : '' }}">
                <td class="border px-4 py-2">{{ $key + 1 }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('users.updateRole', $user) }}" method="POST" class="flex space-x-2 items-center">
                        @csrf
                        <select name="role" class="border rounded px-2 py-1">
                            @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ $user->role === $role ? 'selected' : '' }}>
                                {{ ucfirst($role) }}
                            </option>
                            @endforeach
                        </select>
                        <button type="submit"
                            class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition">
                            Update
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection