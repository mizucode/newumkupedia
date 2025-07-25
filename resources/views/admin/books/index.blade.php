@extends('layouts.dashboard-admin')
@section('title', 'Manajemen Buku')
@section('content')
<div class="max-w-5xl min-h-screen mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Bibliografi Buku</h1>
            <div class="text-sm text-gray-500 mt-1">Total Buku: <span class="font-semibold">{{ method_exists($books, 'total') ? $books->total() : $books->count() }}</span></div>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <button type="submit" class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm font-medium transition">Cari</button>
            </form>
            <a href="{{ route('admin.books.create') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 transition">Tambah Buku Baru</a>
        </div>
    </div>
    <div class="bg-white shadow  overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cover</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Penulis</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($books as $book)
                <tr>
                    <td class="px-4 py-2"><img src="{{ asset('storage/' . $book->cover_image_path) }}" alt="{{$book->title}}" class="h-14 w-10 object-cover rounded shadow"></td>
                    <td class="px-4 py-2 font-medium text-gray-800">{{ $book->title }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $book->author }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.books.edit', $book) }}" class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs font-semibold transition">Edit</a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs font-semibold transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection