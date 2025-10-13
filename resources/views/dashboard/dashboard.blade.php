@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Welcome Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold text-gray-700">Users</h3>
        <p class="text-gray-500 mt-2">Total registered users: <strong>120</strong></p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold text-gray-700">Orders</h3>
        <p class="text-gray-500 mt-2">Total orders placed: <strong>540</strong></p>
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold text-gray-700">Revenue</h3>
        <p class="text-gray-500 mt-2">Monthly revenue: <strong>$12,300</strong></p>
    </div>
</div>
@endsection
