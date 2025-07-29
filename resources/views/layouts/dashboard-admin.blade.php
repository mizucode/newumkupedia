<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
        @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])

<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/dist/css/adminlte.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
<!-- DataTables CSS -->
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@stack('styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar-admin')


    
    <div class="content-wrapper">
        <section class="content pt-3 px-3">
            @yield('content')
        </section>
    </div>



    @include('layouts.footer')
</div>

<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/dist/js/adminlte.min.js') }}"></script>
<!-- DataTables JS -->
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- JSZip (untuk Excel) -->
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/jszip/jszip.min.js') }}"></script>

<!-- pdfmake (untuk PDF) -->
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>

<!-- DataTables dan Buttons -->
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/almasaeed2010/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>


@stack('scripts')
</body>
</html>
