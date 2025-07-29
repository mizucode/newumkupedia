@extends('layouts.dashboard')

@section('content')
<div class=" mx-auto py-8 w-full">
    <div class="w-full mx-auto bg-white rounded-lg px-4 pb-4 shadow">
        <h2 class="text-2xl pt-4 font-bold mb-8 text-center text-blue-700">Daftar Request Buku Saya </h2>
        @if(session('success'))
            <div class="mb-6 p-3 bg-green-100 text-green-800 rounded shadow text-center">{{ session('success') }}</div>
        @endif
        @if(isset($requests) && count($requests) > 0)
            <div class="overflow-x-auto ">
                <table class="min-w-full bg-white border border-gray-200 shadow">
                    <thead class="bg-blue-50">
                        <tr>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">No</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Judul</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Penulis</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Tahun</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Deskripsi</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Alasan</th>
                            <th class="px-4 py-3 border text-left text-gray-900 font-semibold">Request Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($requests as $request)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-3 border text-gray-900 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 border font-semibold text-gray-900">{{ $request->judul }}</td>
                                <td class="px-4 py-3 border text-gray-700">{{ $request->penulis }}</td>
                                <td class="px-4 py-3 border text-gray-700">{{ $request->tahun }}</td>
                                <td class="px-4 py-3 border text-gray-600 max-w-xs " title="{{ $request->deskripsi }}">{{ $request->deskripsi }}</td>
                                <td class="px-4 py-3 border text-gray-600 max-w-xs " title="{{ $request->alasan }}">{{ $request->alasan }}</td>
                                <td class="px-4 py-3 border text-gray-400">{{ $request->created_at->format('d-m-Y H:i') }}</td>
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