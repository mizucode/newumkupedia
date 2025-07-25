@extends('layouts.dashboard-admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-9xl min-h-screen mx-auto px-4 py-8 text-gray-600">
        <div class="mb-4">
            <div class="bg-gradient-to-r from-blue-700 to-blue-900 rounded-xl shadow p-5 flex flex-col sm:flex-row justify-between items-center">
                <div class="text-white mb-3 sm:mb-0">
                    <h4 class="text-lg sm:text-xl font-semibold flex items-center mb-1">
                        <i class="fas fa-user-shield mr-2"></i>
                        Selamat Datang, Admin {{ Auth::user()->name }}
                    </h4>
                    <p class="opacity-80 text-sm">Ini adalah dashboard khusus admin. Anda dapat mengelola data dan melihat statistik.</p>
                </div>
                <div class="text-white opacity-80 text-sm flex items-center">
                    Terakhir login: <?php echo date('d/m/Y H:i'); ?>
                </div>
            </div>
        </div>
        <div class="w-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Metric Item Start -->
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100">
                        <svg class="text-red-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="m19 23.3l-.6-.5c-2-1.9-3.4-3.1-3.4-4.6c0-1.2 1-2.2 2.2-2.2c.7 0 1.4.3 1.8.8c.4-.5 1.1-.8 1.8-.8c1.2 0 2.2.9 2.2 2.2c0 1.5-1.4 2.7-3.4 4.6zM6 22a2 2 0 0 1-2-2V4c0-1.11.89-2 2-2h1v7l2.5-1.5L12 9V2h6a2 2 0 0 1 2 2v9.08L19 13a6.005 6.005 0 0 0-5.2 9z" />
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Total E-book Difavoritkan</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800">
                                {{ $favoriteBooks->count() }}
                            </h4>
                        </div>
                    </div>
                    <div class="w-full mt-3"> <a href="{{ route('favorites.list') }}" class="bg-red-500 w-full font-semibold hover:bg-red-400 rounded-md text-white inline-block py-2 text-center">Lihat</a>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100">
                        <svg class="text-green-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M6 22q-.825 0-1.412-.587T4 20V4q0-.825.588-1.412T6 2h12q.825 0 1.413.588T20 4v16q0 .825-.587 1.413T18 22zm5-11l2.5-1.5L16 11V4h-5z" />
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Total Buku Tersedia</span>
                            <h4 class="mt-2 text-title-sm font-bold text-gray-800">
                                {{ \App\Models\Book::count() }}
                            </h4>
                        </div>
                    </div>
                    <div class="w-full mt-3"> <a href="{{ route('books.index') }}" class="bg-green-500 w-full font-semibold hover:bg-green-400 rounded-md text-white inline-block py-2 text-center">Lihat</a>
                    </div>
                </div>
                <div class="rounded-2xl border border-gray-200 bg-white p-5 md:p-6">
                    <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gray-100">
                        <svg class="text-blue-400" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor" d="M15 7h5.5L15 1.5zM8 0h8l6 6v12a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2M4 4v18h16v2H4a2 2 0 0 1-2-2V4z" />
                        </svg>
                    </div>
                    <div class="mt-5 flex items-end justify-between">
                        <div>
                            <span class="text-sm text-gray-500">Permintaan Buku Baru</span>
                            <h4 class="mt-2 text-title-sm font-bold text-blue-600">
                                {{ \App\Models\RequestEbook::count() }}
                            </h4>
                        </div>
                    </div>
                    <div class="w-full mt-3"> <a href="{{ route('admin.daftarpermintaanebook') }}" class="bg-blue-500 w-full font-semibold hover:bg-blue-400 rounded-md text-white inline-block py-2 text-center">Lihat Permintaan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
