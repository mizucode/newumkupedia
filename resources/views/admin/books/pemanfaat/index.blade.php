@extends('layouts.dashboard-admin')
@section('title', 'Manajemen Buku')
@section('content')
<div class="max-w-3xl min-h-screen mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Pemanfaat</h1>
            <div class="text-sm text-gray-500 mt-1">Total Pemanfaat: <span class="font-semibold">{{ method_exists($pemanfaats, 'total') ? $pemanfaats->total() : $pemanfaats->count() }}</span></div>
        </div>
        <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
            <form method="GET" action="" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="rounded-md border border-gray-300 px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
                <button type="submit" class="px-3 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm font-medium transition">Cari</button>
            </form>
            <a href="{{ route('admin.pemanfaat.create') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md font-medium hover:bg-indigo-700 transition">Tambah Pemanfaat</a>
        </div>
    </div>
    <div class="bg-white shadow  overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode Pemanfaat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Pemanfaat</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse ($pemanfaats as $pemanfaat)
                <tr>
                    <td class="px-4 py-2 font-medium text-gray-800">{{ $pemanfaat->kode_pemanfaat }}</td>
                    <td class="px-4 py-2 text-gray-600">{{ $pemanfaat->nama_pemanfaat }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.pemanfaat.edit', $pemanfaat) }}" class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs font-semibold transition">Edit</a>
                        <form action="{{ route('admin.pemanfaat.destroy', $pemanfaat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pemanfaat ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-block px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs font-semibold transition">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">Belum ada data pemanfaat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection