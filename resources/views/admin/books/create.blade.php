@extends('layouts.app')
@section('title', 'Tambah Buku Baru')
@section('content')
<h1>Tambah Buku Baru</h1>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" name="author" id="author" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Gambar Sampul (Cover)</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control" required accept="image/*">
            </div>
            <div class="mb-3">
                <label for="pdf_file" class="form-label">File PDF Ebook</label>
                <input type="file" name="pdf_file" id="pdf_file" class="form-control" required accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Buku</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection