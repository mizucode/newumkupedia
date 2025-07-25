<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel 11 & Tailwind CSS</title>
        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-slate-900 text-white">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <div class="p-8 bg-slate-800 rounded-xl shadow-lg text-center">
                <h1 class="text-5xl font-extrabold text-cyan-400 mb-4 animate-pulse">
                    Instalasi Berhasil!
                </h1>
                <p class="text-slate-300 text-lg">
                    Anda berhasil menginstall Laravel 11 dan Tailwind CSS menggunakan Vite.
                </p>
                <div class="mt-6 p-4 border border-dashed border-slate-600 rounded-md">
                    <p class="font-mono text-sm">
                        <span class="text-pink-400">Laravel Version:</span> {{ app()->version() }}
                    </p>
                </div>
            </div>
        </div>
    </body>
</html>