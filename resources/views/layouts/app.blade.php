<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Umkupedia Ebook Reader')</title>

    {{-- Alpine.js akan di-bundle melalui Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans text-gray-800 antialiased min-h-screen flex flex-col">

    {{--
      NAVBAR DENGAN ALPINE.JS UNTUK TOGGLE MENU
      x-data mendefinisikan state komponen (isMenuOpen)
      @click akan mengubah state tersebut
      :class atau x-show akan menampilkan/menyembunyikan menu berdasarkan state
    --}}
    <nav x-data="{ isMenuOpen: false }" class="bg-white text-indigo-600 shadow-md sticky top-0 z-50 lg:px-16">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between py-4">
                {{-- Logo/Brand --}}
                <a class="text-2xl font-bold tracking-tight text-indigo-600" href="{{ route('home') }}">Umkupedia</a>

                {{-- Tombol Hamburger untuk Mobile --}}
                <div class="lg:hidden">
                    <button @click="isMenuOpen = !isMenuOpen" type="button" class="text-gray-300 hover:text-white focus:outline-none focus:text-white" aria-label="Toggle navigation">
                        {{-- Icon close (X) saat menu terbuka --}}
                        <svg x-show="isMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        {{-- Icon hamburger saat menu tertutup --}}
                        <svg x-show="!isMenuOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                {{-- Menu untuk Desktop --}}
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    <a class="py-2 px-3 hover:bg-indigo-600 hover:text-white rounded transition duration-150 ease-in-out" href="{{ route('books.index') }}">Semua Buku</a>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <a class="py-2 px-3 hover:bg-indigo-600 hover:text-white rounded transition duration-150 ease-in-out" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                         
                        @else
                            <a class="py-2 px-3 hover:bg-indigo-600 hover:text-white rounded transition duration-150 ease-in-out" href="{{ route('dashboard') }}">Dashboard</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="py-2 px-3 hover:bg-red-600 hover:text-white rounded transition duration-150 ease-in-out align-middle">Logout</button>
                        </form>
                    @endauth
                    @guest
                        <a class="py-2 px-3 hover:bg-indigo-600 hover:text-white rounded transition duration-150 ease-in-out" href="{{ route('login') }}">Login</a>
                        <a class="py-2 px-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition duration-150 ease-in-out" href="{{ route('register') }}">Register</a>
                    @endguest
                </div>
            </div>

            {{-- Menu untuk Mobile (Muncul saat hamburger di-klik) --}}
            <div x-show="isMenuOpen" x-transition class="lg:hidden pb-4">
                <ul class="flex flex-col space-y-2">
                    <li><a class="block py-2 px-3 hover:bg-indigo-600  hover:text-white rounded transition duration-150" href="{{ route('books.index') }}">Semua Buku</a></li>
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <li><a class="block py-2 px-3 hover:bg-indigo-600 rounded transition duration-150" href="{{ route('admin.dashboard') }}">Dashboard Admin</a></li>
                          
                        @else
                            <li><a class="block py-2 px-3 hover:bg-indigo-600 rounded transition duration-150" href="{{ route('dashboard') }}">Dashboard</a></li>
                        @endif
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left py-2 px-3 hover:bg-indigo-600 rounded transition duration-150">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li><a class="block py-2 px-3 hover:bg-indigo-600  hover:text-white rounded transition duration-150" href="{{ route('login') }}">Login</a></li>
                        <li><a class="block py-2 px-3 hover:bg-indigo-600 hover:text-white rounded transition duration-150" href="{{ route('register') }}">Register</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="">
        {{-- Flash Messages yang lebih baik dengan icon dan tombol close --}}
        @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 flex justify-between items-center" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p>{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-green-700 hover:text-green-900">×</button>
        </div>
        @endif
        @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 flex justify-between items-center" role="alert">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <p>{{ session('error') }}</p>
            </div>
            <button @click="show = false" class="text-red-700 hover:text-red-900">×</button>
        </div>
        @endif

        @yield('content')
    </main>

    <footer class="text-center py-6 bg-gray-800 text-gray-400">
        <p>© {{ date('Y') }} Umkupedia. Hak Cipta Dilindungi.</p>
    </footer>

</body>

</html>