
@extends('layouts.dashboard-admin')
@section('title', 'Edit Pemanfaat')
@section('content')
<div class=" mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pemanfaat: {{ $pemanfaat->nama_pemanfaat }}</h1>
    <div class="bg-white shadow rounded-xl p-8">
        <form action="{{ route('admin.pemanfaat.update', $pemanfaat) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="kode_pemanfaat" class="block text-sm font-medium text-gray-700 mb-1">Kode Pemanfaat</label>
                <input type="text" name="kode_pemanfaat" id="kode_pemanfaat" value="{{ $pemanfaat->kode_pemanfaat }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">
            </div>
            <div>
                <label for="nama_pemanfaat" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemanfaat</label>
                <input type="text" name="nama_pemanfaat" id="nama_pemanfaat" value="{{ $pemanfaat->nama_pemanfaat }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 transition">Update</button>
                <a href="{{ route('admin.pemanfaat.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-medium hover:bg-gray-300 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection