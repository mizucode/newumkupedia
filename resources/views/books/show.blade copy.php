@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    <div class="md:w-1/3 w-full flex-shrink-0">
        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="w-full h-auto rounded-lg shadow-lg object-cover" alt="{{ $book->title }}">
    </div>
    <div class="md:w-2/3 w-full">
        <h1 class="text-3xl font-bold mb-2">{{ $book->title }}</h1>
        <h5 class="text-gray-500 mb-4">oleh {{ $book->author }}</h5>
        <div class="border-b border-gray-200 mb-4"></div>
        <h4 class="text-xl font-semibold mb-2">Deskripsi</h4>
        <p class="mb-6 text-gray-700">{{ $book->description }}</p>

        @auth
            {{-- Tombol Baca untuk User Login --}}
            <a href="{{ route('books.read', $book->slug) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition-colors duration-200 mr-2 mb-2" target="_blank">Baca Sekarang</a>

            {{-- Tombol Favorit --}}
            <form action="{{ route('favorites.toggle', $book) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit" class="py-2 px-6 rounded-lg shadow font-semibold transition-colors duration-200 mb-2 {{ $isFavorited ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-white border border-red-600 text-red-600 hover:bg-red-50' }}">
                    {{ $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                </button>
            </form>
        @endauth

        @guest
            {{-- Pesan untuk Guest --}}
            <div class="mt-4 p-4 bg-blue-100 border border-blue-300 text-blue-800 rounded-lg">
                <a href="{{ route('login') }}" class="underline font-semibold text-blue-700 hover:text-blue-900">Login</a> untuk mulai membaca buku ini.
            </div>
        @endguest
    </div>
</div>
@endsection