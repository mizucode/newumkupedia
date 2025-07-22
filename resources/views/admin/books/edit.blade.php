@extends('layouts.app')
@section('title', 'Edit Buku')
@section('content')
<h1>Edit Buku: {{ $book->title }}</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="5" class="form-control" required>{{ $book->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Gambar Sampul (Cover)</label>
                <p>Cover saat ini: <img src="{{ asset('storage/' . $book->cover_image_path) }}" width="100"></p>
                <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah cover.</small>
            </div>
            <div class="mb-3">
                <label for="pdf_file" class="form-label">File PDF Ebook</label>
                <p>File saat ini: <a href="{{ route('books.read', $book) }}" target="_blank">Lihat PDF</a></p>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control" accept=".pdf">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah file PDF.</small>
            </div>
            <button type="submit" class="btn btn-primary">Update Buku</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection