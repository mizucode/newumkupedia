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

    <div class="flex flex-1 items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h2 class="mb-6 text-center text-2xl font-bold text-gray-900">Login Ke <span class="text-indigo-800">Umkupedia</span></h2>
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900 @error('username') border-red-500 @enderror">
                        @error('username')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-gray-900">
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md bg-indigo-600 text-white font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">Login</button>
                    </div>

                
                </form>
                <div class="mt-6 text-center text-sm text-gray-600">
                    Belum punya akun?
                    <a href="/register" class="font-semibold text-indigo-600 hover:text-indigo-800 transition underline underline-offset-2">Daftar di sini</a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>