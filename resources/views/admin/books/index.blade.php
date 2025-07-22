@extends('layouts.app')
@section('title', 'Manajemen Buku')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Manajemen Buku</h1>
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                <tr>
                    <td><img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{$book->title}}" width="50"></td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection