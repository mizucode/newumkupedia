@extends('layouts.dashboard')

@section('content')
<div class=" mx-auto py-8">
    <div class=" mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-center">Request E-book Baru</h2>
        <form action="{{ route('admin.requestebook.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="judul" class="block text-gray-700 font-semibold mb-2">Judul Buku</label>
                <input type="text" name="judul" id="judul" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div class="mb-4">
                <label for="penulis" class="block text-gray-700 font-semibold mb-2">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div class="mb-4">
                <label for="tahun" class="block text-gray-700 font-semibold mb-2">Tahun Terbit</label>
                <input type="number" name="tahun" id="tahun" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" required>
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="block text-gray-700 font-semibold mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" required></textarea>
            </div>
            <div class="mb-6">
                <label for="alasan" class="block text-gray-700 font-semibold mb-2">Alasan Request</label>
                <textarea name="alasan" id="alasan" rows="2" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring" required></textarea>
            </div>
            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Kirim Request</button>
        </form>

        <!-- Daftar buku yang direquest oleh user -->
        
    </div>

</div>
@endsection
