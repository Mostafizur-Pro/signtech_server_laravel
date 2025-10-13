@extends('layouts.app')

@section('title', 'QR Generator')
@section('page-title', 'QR Code Generator')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow-md">

    <!-- QR Code Form -->
    <form action="{{ route('qr.generate') }}" method="POST" class="mb-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Model:</label>
                <input type="text" name="model" value="{{ old('model') }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('model')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Machine Type:</label>
                <select name="type" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
                    <option value="">Select Type</option>
                    <option value="Cassette" {{ old('type') == 'Cassette' ? 'selected' : '' }}>Cassette Type</option>
                    <option value="Duct" {{ old('type') == 'Duct' ? 'selected' : '' }}>Duct Type</option>
                    <option value="FCU" {{ old('type') == 'FCU' ? 'selected' : '' }}>FCU</option>
                </select>
                @error('type')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Quantity:</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" min="1" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('quantity')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Invoice Number:</label>
                <input type="text" name="invoice" value="{{ old('invoice', '0001') }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('invoice')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">Date:</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:ring-blue-200">
                @error('date')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">Generate QR Codes</button>
        </div>
    </form>

    <!-- Display Generated QR Codes -->
    @isset($qrCodes)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach ($qrCodes as $qr)
        <div class="text-center p-2 border rounded bg-gray-50">
            <div class="mb-2 font-semibold text-sm">{{ $qr['model'] }} - {{ $qr['type'] }}</div>
            <div class="text-xs mb-1">Invoice: {{ $qr['invoice'] }}</div>
            <div class="text-xs mb-1">Date: {{ $qr['date'] }}</div>
            <div class="text-xs mb-2">SN: {{ $qr['sn'] }}</div>
            {!! $qr['code'] !!}
        </div>
        @endforeach
    </div>
    @endisset

</div>
@endsection
