@extends('layouts.dashboard-admin')

@section('title', 'Laporan Data Buku')

@section('content')
<div class="w-full">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- ID 'filtered_book_count' akan diperbarui oleh JavaScript --}}
                    <h3 class="card-title">Data Buku Tersedia (<span id="filtered_book_count">Memuat...</span>)</h3>
                </div>
                <div class="card-body">
                    {{-- Filter Berdasarkan Tahun --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="tahun_mulai">Tahun Terbit Mulai:</label>
                            <input type="number" id="tahun_mulai" class="form-control" placeholder="Contoh: 2000">
                        </div>
                        <div class="col-md-4">
                            <label for="tahun_akhir">Tahun Terbit Akhir:</label>
                            <input type="number" id="tahun_akhir" class="form-control" placeholder="Contoh: {{ date('Y') }}">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button id="filter_data_buku" class="btn btn-primary btn-block">Filter Data</button>
                        </div>
                    </div>

                    {{-- Filter Tambahan untuk Penulis, Penerbit, ISBN, No. Klasifikasi, No. Panggil, Deskripsi, Pemanfaat --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="filter_author">Penulis:</label>
                            <input type="text" id="filter_author" class="form-control" placeholder="Cari Penulis">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_penerbit">Penerbit:</label>
                            <input type="text" id="filter_penerbit" class="form-control" placeholder="Cari Penerbit">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_isbn">ISBN:</label>
                            <input type="text" id="filter_isbn" class="form-control" placeholder="Cari ISBN">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="filter_nomor_klasifikasi">No. Klasifikasi:</label>
                            <input type="text" id="filter_nomor_klasifikasi" class="form-control" placeholder="Cari No. Klasifikasi">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_nomor_panggil">No. Panggil:</label>
                            <input type="text" id="filter_nomor_panggil" class="form-control" placeholder="Cari No. Panggil">
                        </div>
                        <div class="col-md-4">
                            <label for="filter_description">Deskripsi:</label>
                            <input type="text" id="filter_description" class="form-control" placeholder="Cari Deskripsi">
                        </div>
                    </div>
                    <div class="row mb-3">
                         <div class="col-md-4">
                            <label for="filter_pemanfaat">Pemanfaat:</label>
                            <input type="text" id="filter_pemanfaat" class="form-control" placeholder="Cari Pemanfaat">
                        </div>
                    </div>

                </div>
                
            </div>
            <div class="card">
             
                <div class="card-body table-responsive">
                    {{-- DataTables will be initialized here --}}
                    <table id="laporanBukuTable" class="table table-bordered table-striped text-sm w-full">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Tahun Terbit</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Pemanfaat</th> {{-- Pastikan ada kolom untuk Pemanfaat --}}
                                <th>Halaman</th>
                                <th>No. Klasifikasi</th>
                                <th>No. Panggil</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data akan dimuat oleh DataTables melalui permintaan AJAX --}}
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>
    $(function () {
        var laporanBukuTable = $('#laporanBukuTable').DataTable({
            processing: true, // Menampilkan indikator loading
            serverSide: true, // Mengaktifkan pemrosesan sisi server
            ajax: {
                url: "{{ route('admin.laporan.buku') }}", // Pastikan route ini sudah terdaftar di web.php
                type: "GET",
                // Mengirimkan nilai filter dari input ke server
                data: function (d) {
                    d.tahun_mulai = $('#tahun_mulai').val();
                    d.tahun_akhir = $('#tahun_akhir').val();
                    d.filter_author = $('#filter_author').val();
                    d.filter_penerbit = $('#filter_penerbit').val();
                    d.filter_isbn = $('#filter_isbn').val();
                    d.filter_nomor_klasifikasi = $('#filter_nomor_klasifikasi').val();
                    d.filter_nomor_panggil = $('#filter_nomor_panggil').val();
                    d.filter_description = $('#filter_description').val();
                    // --- Perbaikan di sini ---
                    d.filter_pemanfaat = $('#filter_pemanfaat').val(); // Parameter baru untuk filter pemanfaat
                },
                // Fungsi callback setelah data diterima dari server
                dataSrc: function (json) {
                    // Perbarui teks total buku yang difilter di header tabel
                    $('#filtered_book_count').text('Total: ' + json.recordsFiltered + ' (dari ' + json.recordsTotal + ' keseluruhan)');
                    return json.data; // Kembalikan data untuk ditampilkan di tabel
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'author', name: 'author' },
                { data: 'tahun_terbit', name: 'tahun_terbit' },
                { data: 'penerbit', name: 'penerbit' },
                { data: 'isbn', name: 'isbn' },
                { data: 'pemanfaat', name: 'pemanfaat' }, // Pastikan ini sesuai dengan nama kolom di database atau relasi
                { data: 'jumlah_halaman', name: 'jumlah_halaman' },
                { data: 'nomor_klasifikasi', name: 'nomor_klasifikasi' },
                { data: 'nomor_panggil', name: 'nomor_panggil' },
                { 
                    data: 'description', 
                    name: 'description', 
                    orderable: false, 
                    searchable: false, 
                    render: function(data, type, row) {
                        return data.length > 50 ? data.substr(0, 50) + '...' : data;
                    }
                },
            ],
            order: [[3, 'desc']],
            dom: 'lBfrtip',
            lengthChange: false,
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Cetak Laporan',
                    title: 'Laporan Data Buku',
                    exportOptions: {
                        columns: ':visible'
                    },
                    customize: function (win) {
                        $(win.document.body).find('h1').text('Laporan Data Buku');
                        $(win.document.body).find('table').addClass('display').css('font-size', '10pt');
                        $(win.document.body).find('table tbody td:last-child').each(function() {
                            var originalDescription = laporanBukuTable.row($(this).closest('tr')).data().description;
                            $(this).text(originalDescription);
                        });
                    }
                },
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        });

        // Event listener untuk tombol "Filter Data"
        $('#filter_data_buku').on('click', function () {
            laporanBukuTable.draw();
        });

        // Event listener untuk semua input filter teks dan tahun
        // Menambahkan filter_pemanfaat ke daftar event listener
        $('#filter_author, #filter_penerbit, #filter_isbn, #filter_nomor_klasifikasi, #filter_nomor_panggil, #filter_description, #filter_pemanfaat, #tahun_mulai, #tahun_akhir').on('keyup change', function() {
            laporanBukuTable.draw();
        });
    });
</script>
@endpush