@extends('layouts.app')

@section('title', $book->title)

@section('content')

<div class="px-2 md:px-8 lg:px-16 py-8 md:py-16 flex justify-center">
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 w-full max-w-4xl">
        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="shadow-md rounded-lg object-cover w-40 h-56 md:w-[220px] md:h-[320px] lg:w-[260px] lg:h-[380px] mb-4 md:mb-0" alt="Cover {{ $book->title }}">
        <div class="w-full max-w-xl px-8 lg:px-0">
            <div class="mb-3 text-center">
                <h1 class="font-bold text-2xl  md:text-4xl">{{ $book->title }}</h1>
                <h2 class="font-bold text-base md:text-lg text-slate-600">Author: {{ $book->author }}</h2>
                <p class="text-justify text-sm md:text-base mt-2">{{ $book->description }}</p>
            </div>
            <div class="space-y-2 mb-6 bg-white px-2 md:px-4 py-2 rounded-lg shadow-md">
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">Judul Ebook</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->title }}</span></div>
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">Deskripsi / Sinopsis</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->description }}</span></div>
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">Penulis</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->author }}</span></div>
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">Jumlah Halaman</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->jumlah_halaman }}</span></div>
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">ISBN</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->isbn }}</span></div>
                <div class="flex items-start"><span class="w-40 font-semibold text-gray-700">Tahun Terbit</span><span class="mx-2">:</span><span class="text-gray-900">{{ $book->tahun_terbit }}</span></div>
            </div>

            <div class="mt-4">
                @auth
                    {{-- Tombol Baca untuk User Login --}}
                    <a href="{{ route('books.read', $book->slug) }}" class="inline-block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition-colors duration-200 mr-2 mb-2" target="_blank">Baca Sekarang</a>

                    {{-- Tombol Favorit --}}
<form action="{{ route('favorites.toggle', $book) }}" method="POST" class="w-full">
    @csrf
    <button type="submit" class="w-full py-2 px-6 text-center rounded-lg shadow font-semibold transition-colors duration-200 mb-2 {{ $isFavorited ? 'bg-red-600 hover:bg-red-700 text-white' : 'bg-white border border-red-600 text-red-600 hover:bg-red-50' }}">
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
    </div>
</div>
@endsection