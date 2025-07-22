@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="row">
    <div class="col-md-4">
        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="img-fluid rounded shadow" alt="{{ $book->title }}">
    </div>
    <div class="col-md-8">
        <h1>{{ $book->title }}</h1>
        <h5 class="text-muted">oleh {{ $book->author }}</h5>
        <hr>
        <h4>Deskripsi</h4>
        <p>{{ $book->description }}</p>

        @auth
            {{-- Tombol Baca untuk User Login --}}
            <a href="{{ route('books.read', $book->slug) }}" class="btn btn-success btn-lg me-2" target="_blank">Baca Sekarang</a>

            {{-- Tombol Favorit --}}
            <form action="{{ route('favorites.toggle', $book) }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn {{ $isFavorited ? 'btn-danger' : 'btn-outline-danger' }} btn-lg">
                    {{ $isFavorited ? 'Hapus dari Favorit' : 'Tambah ke Favorit' }}
                </button>
            </form>
        @endauth
        
        @guest
            {{-- Pesan untuk Guest --}}
            <div class="alert alert-info mt-3">
                <a href="{{ route('login') }}">Login</a> untuk mulai membaca buku ini.
            </div>
        @endguest
    </div>
</div>
@endsection