@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<h1 class="mb-4">Daftar Ebook</h1>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
    @forelse($books as $book)
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
    @empty
        <div class="col">
            <p>Belum ada buku yang tersedia.</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $books->links() }}
</div>
@endsection