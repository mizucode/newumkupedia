@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')



<div id="semuabuku"></div>

<section class="py-8 px-16">

    <h1 class="mb-2 text-center text-3xl font-semibold">Daftar Ebook</h1>
    <h2 class="text-center text-slate-400">Jelajahi semua buku kesukaan mu dan hal yang berkaitan dengannya
    </h2>
    <form method="GET" action="{{ route('books.index') }}" class="my-4">
        <div class="flex rounded-lg overflow-hidden shadow-sm">
            <input
                type="text"
                name="q"
                placeholder="Cari judul atau penulis..."
                value="{{ request('q') }}"
                class="w-full px-4 py-4 text-sm border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-l-lg">
            <button
                type="submit"
                class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 rounded-r-lg">
                Cari
            </button>
        </div>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-16 ">
        @forelse($books as $book)
        <div class="flex">
            <div class="bg-white rounded-lg shadow-md flex flex-col w-full">
                <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="w-full h-80 object-cover rounded-t-lg" alt="{{ $book->title }}">
                <div class="flex flex-col flex-1 p-4">
                    <h5 class="text-lg font-semibold mb-2">{{ $book->title }}</h5>
                    <p class="text-sm text-gray-500 mb-4">oleh {{ $book->author }}</p>
                    <a href="{{ route('books.show', $book->slug) }}" class="mt-auto inline-block px-4 py-2 text-center bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">Lihat Detail</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center">
            <p>Belum ada buku yang tersedia.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
    @endsection
</section>