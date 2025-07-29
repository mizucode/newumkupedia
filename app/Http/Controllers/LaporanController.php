<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;


class LaporanController extends Controller
{
    /**
     * Menampilkan laporan data buku dengan dukungan DataTables dan filter dinamis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function laporanBuku(Request $request)
    {
        // Tangani permintaan AJAX dari DataTables
        if ($request->ajax()) {
            // Inisialisasi query dengan eager loading relasi 'pemanfaatRelasi'
            $query = Book::query()->with('pemanfaatRelasi');
            
            // --- Filter Berdasarkan Rentang Tahun Terbit ---
            if ($request->filled('tahun_mulai')) {
                $query->where('tahun_terbit', '>=', $request->input('tahun_mulai'));
            }
            if ($request->filled('tahun_akhir')) {
                $query->where('tahun_terbit', '<=', $request->input('tahun_akhir'));
            }

            // --- Filter Tambahan Berdasarkan Input Individual ---
            if ($request->filled('filter_author')) {
                $query->where('author', 'like', '%' . $request->input('filter_author') . '%');
            }
            if ($request->filled('filter_penerbit')) {
                $query->where('penerbit', 'like', '%' . $request->input('filter_penerbit') . '%');
            }
            if ($request->filled('filter_isbn')) {
                $query->where('isbn', 'like', '%' . $request->input('filter_isbn') . '%');
            }
            if ($request->filled('filter_nomor_klasifikasi')) {
                $query->where('nomor_klasifikasi', 'like', '%' . $request->input('filter_nomor_klasifikasi') . '%');
            }
            if ($request->filled('filter_nomor_panggil')) {
                $query->where('nomor_panggil', 'like', '%' . $request->input('filter_nomor_panggil') . '%');
            }
            if ($request->filled('filter_description')) {
                $query->where('description', 'like', '%' . $request->input('filter_description') . '%');
            }
            // --- Perbaikan filter pemanfaat ---
            if ($request->filled('filter_pemanfaat')) {
                // Asumsi 'pemanfaat' adalah kolom di tabel 'books' yang menyimpan nama pemanfaat
                // Jika 'pemanfaat' adalah relasi ke tabel lain (misal User), Anda mungkin perlu join atau whereHas
                $query->where('pemanfaat', 'like', '%' . $request->input('filter_pemanfaat') . '%');
            }

            // --- Pencarian Global DataTables (Search Box) ---
            if ($request->filled('search.value')) {
                $searchValue = $request->input('search.value');
                $query->where(function($q) use ($searchValue) {
                    $q->where('title', 'like', '%' . $searchValue . '%')
                      ->orWhere('slug', 'like', '%' . $searchValue . '%')
                      ->orWhere('author', 'like', '%' . $searchValue . '%')
                      ->orWhere('description', 'like', '%' . $searchValue . '%')
                      ->orWhere('jumlah_halaman', 'like', '%' . $searchValue . '%')
                      ->orWhere('isbn', 'like', '%' . $searchValue . '%')
                      ->orWhere('tahun_terbit', 'like', '%' . $searchValue . '%')
                      ->orWhere('penerbit', 'like', '%' . $searchValue . '%')
                      ->orWhere('pemanfaat', 'like', '%' . $searchValue . '%') // Pastikan ini juga di global search
                      ->orWhere('nomor_klasifikasi', 'like', '%' . $searchValue . '%')
                      ->orWhere('nomor_panggil', 'like', '%' . $searchValue . '%');
                });
            }

            // --- Pengurutan DataTables ---
            if ($request->filled('order.0.column')) {
                $columnIndex = $request->input('order.0.column');
                $columnName = $request->input('columns.' . $columnIndex . '.data');
                $orderDir = $request->input('order.0.dir'); // 'asc' atau 'desc'

                // Daftar kolom yang valid untuk pengurutan
                $validColumns = [
                    'id', 'title', 'slug', 'author', 'description', 'jumlah_halaman',
                    'isbn', 'tahun_terbit', 'penerbit', 'pemanfaat', // Tambahkan 'pemanfaat'
                    'nomor_klasifikasi', 'nomor_panggil',
                ];
                if (in_array($columnName, $validColumns)) {
                    $query->orderBy($columnName, $orderDir);
                }
            } else {
                // Pengurutan default jika tidak ada permintaan pengurutan dari DataTables
                $query->latest('tahun_terbit'); 
            }

            // Hitung total buku setelah semua filter diterapkan (sebelum paginasi)
            $totalFiltered = $query->count();

            // --- Paginasi DataTables ---
            $start = $request->input('start');
            $length = $request->input('length');

            if ($length != -1) { // Jika 'length' bukan '-1' (tampilkan semua)
                $query->offset($start)->limit($length);
            }

            // Ambil data buku
            $books = $query->get();

            // Hitung total buku tanpa filter untuk 'recordsTotal' DataTables
            $totalRecords = Book::count();

            // Format data untuk DataTables
            $data = [];
            foreach ($books as $book) {
                $data[] = [
                    'id' => $book->id,
                    'title' => $book->title,
                    'slug' => $book->slug,
                    'author' => $book->author,
                    'description' => $book->description,
                    'jumlah_halaman' => $book->jumlah_halaman,
                    'isbn' => $book->isbn,
                    'tahun_terbit' => $book->tahun_terbit,
                    'penerbit' => $book->penerbit,
                    'pemanfaat' => $book->pemanfaat, 
                    'nomor_klasifikasi' => $book->nomor_klasifikasi,
                    'nomor_panggil' => $book->nomor_panggil,
                    'cover_image_path' => $book->cover_image_path,
                    'pdf_path' => $book->pdf_path,
                ];
            }

            // Kembalikan respons JSON yang diformat untuk DataTables
            return response()->json([
                'draw' => intval($request->input('draw')),
                'recordsTotal' => intval($totalRecords),
                'recordsFiltered' => intval($totalFiltered),
                'data' => $data,
            ]);
        }

        // Jika bukan permintaan AJAX, tampilkan view awal
        $getallbooks = Book::latest()->get(); 
        return view('admin.laporan.buku', compact('getallbooks'));
    }

    public function laporanPengguna(){
        $getallusers = User::orderBy('created_at', 'desc')->get();
        return view('admin.laporan.pengguna', compact('getallusers'));
    }
    
}