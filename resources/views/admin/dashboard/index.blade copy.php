@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-6xl min-h-screen mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p class="text-gray-600 mb-6">Ini adalah halaman dashboard Anda.</p>

    <hr class="my-6">

    <h2 class="text-xl font-semibold text-gray-700 mb-4">Buku Favorit Anda</h2>
    @if($favoriteBooks->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($favoriteBooks as $book)
                <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition overflow-hidden flex flex-col">
                    <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{ $book->title }}" class="h-48 w-full object-cover">
                    <div class="flex-1 flex flex-col p-4">
                        <h5 class="text-lg font-semibold text-gray-800 mb-1">{{ $book->title }}</h5>
                        <p class="text-sm text-gray-500 mb-4">oleh {{ $book->author }}</p>
                        <a href="{{ route('books.show', $book->slug) }}"
                           class="mt-auto inline-block px-4 py-2 bg-indigo-600 text-white rounded-md font-medium text-center hover:bg-indigo-700 transition">Lihat Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Anda belum memiliki buku favorit. Jelajahi <a href="{{ route('books.index') }}" class="text-indigo-600 hover:underline">daftar buku</a> dan tambahkan beberapa!</p>
    @endif
</div>
@endsection