@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<section class="bg-indigo-600 flex items-center justify-center min-h-screen lg:px-16 px-8 py-16 sm:px-6 lg:py-0">
  <div class="text-center max-w-8xl space-y-4">
    <h1 class="text-4xl font-bold  text-white sm:text-5xl lg:text-6xl">
      Selamat Datang di Umkupedia
    </h1>
    <h2 class="text-lg font-medium text-indigo-100 sm:text-xl">
      Silahkan Login dan Register menggunakan akun anda
    </h2>
    <p class="text-indigo-200 leading-relaxed">
      Platform Umkupedia hadir sebagai solusi digital dalam pengelolaan buku digital Universitas Muhammadiyah Kuningan.
    </p>
    <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
      <a href="{{ route('login') }}" class="inline-block px-6 py-3 bg-white text-indigo-700 font-semibold rounded shadow hover:bg-indigo-50 transition">Login</a>
      <a href="{{ route('books.index') }}" class="inline-block px-6 py-3 bg-yellow-300 text-slate-700 font-semibold rounded shadow hover:bg-indigo-800 transition">Lihat Semua Buku</a>
    </div>
  </div>

</section>
@endsection
</section>