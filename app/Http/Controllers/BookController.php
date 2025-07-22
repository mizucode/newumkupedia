<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(12);
        return view('books.index', compact('books'));
    }

    public function show(Book $book)
    {
        $isFavorited = auth()->check() ? auth()->user()->favorites->contains($book) : false;
        return view('books.show', compact('book', 'isFavorited'));
    }

    /**
     * Menampilkan halaman baca buku dengan efek page-flip.
     * Route ini dilindungi oleh middleware 'auth'.
     */
    public function read(Book $book)
    {
        return view('books.read', compact('book'));
    }

    public function servePdf(Book $book)
    {
        $path = storage_path('app/public/' . $book->pdf_path);

        if (!Storage::disk('public')->exists($book->pdf_path)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        return response()->file($path);
    }

}