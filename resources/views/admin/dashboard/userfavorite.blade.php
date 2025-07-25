@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6 text-blue-700">Daftar Buku Favorit Saya</h2>
    @if($favoriteBooks->isEmpty())
        <div class="bg-blue-100 text-blue-700 p-4 rounded shadow mb-4">Belum ada buku favorit.</div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($favoriteBooks as $book)
            <div class="bg-white rounded-lg shadow-md flex flex-col items-center p-4 relative group transition-transform duration-200 hover:-translate-y-1 hover:shadow-xl">
                <div class="w-full h-40 bg-gradient-to-br from-blue-100 to-blue-300 rounded-t-lg flex items-center justify-center mb-4 overflow-hidden">
                    <img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="Cover {{ $book->title }}" class="object-cover w-full h-full rounded-t-lg" />
                </div>
                <h5 class="text-lg font-semibold text-blue-800 mb-2 text-center">{{ $book->title }}</h5>
                <p class="text-gray-600 text-sm mb-4 text-center line-clamp-3">{{ $book->description ?? '-' }}</p>
                <a href="{{ route('books.show', $book->id) }}" class="mt-auto inline-block bg-blue-300 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Lihat Detail</a>
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-400 to-blue-200 rounded-t-lg"></div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection