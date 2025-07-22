@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
    <p>Ini adalah halaman dashboard Anda.</p>
    
    <hr>
    
    <h2>Buku Favorit Anda</h2>
    @if($favoriteBooks->isNotEmpty())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach($favoriteBooks as $book)
                <div class="col">
                    <div class="card book-card shadow-sm">
                        <img src="{{ asset('storage/' . $book->cover_image_path) }}" class="card-img-top" alt="{{ $book->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text text-muted">oleh {{ $book->author }}</p>
                            <a href="{{ route('books.show', $book->slug) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Anda belum memiliki buku favorit. Jelajahi <a href="{{ route('books.index') }}">daftar buku</a> dan tambahkan beberapa!</p>
    @endif
</div>
@endsection