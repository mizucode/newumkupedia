@extends('layouts.dashboard')

@section('content')
<div class="container mx-auto py-8">
    <div class="max-w-5xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-8 text-center text-blue-700">Daftar Request Buku Anda</h2>
        @if(session('success'))
            <div class="mb-6 p-3 bg-green-100 text-green-800 rounded shadow text-center">{{ session('success') }}</div>
        @endif
        @if(isset($requests) && count($requests) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-lg">
                    <thead>
                        <tr class="bg-gradient-to-r from-blue-100 to-blue-300">
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Judul</th>
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Penulis</th>
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Tahun</th>
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Deskripsi</th>
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Alasan</th>
                            <th class="px-6 py-3 border-b-2 border-blue-300 text-left text-blue-800 font-bold">Request Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $i => $request)
                            <tr class="{{ $i % 2 == 0 ? 'bg-white' : 'bg-blue-50' }} hover:bg-blue-100 transition duration-150">
                                <td class="px-6 py-3 border-b border-gray-200 font-semibold text-gray-900">{{ $request->judul }}</td>
                                <td class="px-6 py-3 border-b border-gray-200 text-gray-700">{{ $request->penulis }}</td>
                                <td class="px-6 py-3 border-b border-gray-200 text-gray-700">{{ $request->tahun }}</td>
                                <td class="px-6 py-3 border-b border-gray-200 text-gray-600 max-w-xs truncate" title="{{ $request->deskripsi }}">{{ Str::limit($request->deskripsi, 40) }}</td>
                                <td class="px-6 py-3 border-b border-gray-200 text-gray-600 max-w-xs truncate" title="{{ $request->alasan }}">{{ Str::limit($request->alasan, 40) }}</td>
                                <td class="px-6 py-3 border-b border-gray-200 text-xs text-gray-400">{{ $request->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-gray-500 text-center py-8">Belum ada request buku.</div>
        @endif
    </div>
</div>
@endsection