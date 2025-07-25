<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'AdminLTE Laravel')</title>
        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])

    <!-- AdminLTE CSS -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <div class="content-wrapper">
        <section class="content pt-3 px-3">
            @yield('content')
        </section>
    </div>

    @include('layouts.footer')
</div>

<!-- AdminLTE JS -->
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
