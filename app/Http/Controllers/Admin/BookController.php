<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use App\Models\Pemanfaat;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $books = $query->latest()->paginate(10)->withQueryString();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $pemanfaat = Pemanfaat::all();

        return view('admin.books.create', compact('pemanfaat'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'slug' => 'nullable|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'jumlah_halaman' => 'nullable|integer|min:1',
            'isbn' => 'nullable|string|max:50',
            'tahun_terbit' => 'nullable|integer|min:1000|max:3000',
            'penerbit' => 'nullable|string|max:255',
            'pemanfaat' => 'nullable|string|max:255',
            'nomor_klasifikasi' => 'nullable|string|max:255',
            'nomor_panggil' => 'nullable|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:30720 ',
            'pdf_file' => 'required|mimes:pdf|max:30720 ', // max 10MB
        ]);

       

        // Handle Cover Image Upload
        $coverPath = $request->file('cover_image')->store('covers', 'public');

        // Handle PDF File Upload
        $pdfPath = $request->file('pdf_file')->store('pdfs', 'public');

        Book::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'author' => $request->author,
            'description' => $request->description,
            'jumlah_halaman' => $request->jumlah_halaman,
            'isbn' => $request->isbn,
            'tahun_terbit' => $request->tahun_terbit,
            'penerbit' => $request->penerbit,
            'pemanfaat' => $request->pemanfaat,
            'nomor_klasifikasi' => $request->nomor_klasifikasi,
            'nomor_panggil' => $request->nomor_panggil,
            'cover_image_path' => $coverPath,
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }


    public function edit(Book $book)
    {
        $pemanfaat = Pemanfaat::all();
        $currentPemanfaat = Pemanfaat::where('kode_pemanfaat', $book->pemanfaat)->first();
        return view('admin.books.edit', compact('book', 'pemanfaat', 'currentPemanfaat'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Note: Mengupdate file PDF akan menjadi operasi yang berat.
        // Untuk saat ini, kita hanya perbolehkan update data teks.
        $bookData = $request->only(['title', 'author', 'description']);

        $book->update($bookData);

        return redirect()->route('admin.books.index')->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        // Hapus file dari storage
        Storage::disk('public')->delete($book->cover_image_path);
        Storage::disk('public')->delete($book->pdf_path); // Hapus PDF

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
