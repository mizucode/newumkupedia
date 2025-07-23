@extends('layouts.app')
@section('title', 'Edit Buku')
@section('content')
<div class="max-w-2xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Buku: {{ $book->title }}</h1>
    <div class="bg-white shadow rounded-xl p-8">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Buku</label>
                <input type="text" name="title" id="title" value="{{ $book->title }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">
            </div>
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                <input type="text" name="author" id="author" value="{{ $book->author }}" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="description" id="description" rows="5" required
                    class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">{{ $book->description }}</textarea>
            </div>
            <div>
                <label for="cover_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Sampul (Cover)</label>
                <div class="mb-2">Cover saat ini:<br>
                    <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="h-24 rounded shadow border mt-1">
                </div>
                <input type="file" name="cover_image" id="cover_image" accept="image/*"
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah cover.</p>
            </div>
            <div>
                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">File PDF Ebook</label>
                <div class="mb-2">File saat ini: <a href="{{ route('books.read', $book) }}" target="_blank" class="text-indigo-600 hover:underline">Lihat PDF</a></div>
                <input type="file" name="pdf_file" id="pdf_file" accept=".pdf"
                    class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah file PDF.</p>
            </div>
            <div class="flex gap-2">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 transition">Update Buku</button>
                <a href="{{ route('admin.books.index') }}"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md font-medium hover:bg-gray-300 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection