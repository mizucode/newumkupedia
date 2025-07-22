<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

   public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:books,title',
            'author' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:10240', // max 10MB
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
            'cover_image_path' => $coverPath,
            'pdf_path' => $pdfPath,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan.');
    }


    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
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