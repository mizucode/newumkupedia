<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Pemanfaat;

class BookController extends Controller
{
    public function index()
    {
        $query = request('q');
        $books = Book::query()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('author', 'like', "%$query%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();
        return view('books.index', compact('books'));
    }
    public function home()
    {
        $query = request('q');
        $books = Book::query()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                    ->orWhere('author', 'like', "%$query%");
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();
        return view('books.home', compact('books'));
    }

    public function show(Book $book)
    {
        $pemanfaat = null;
        if ($book->pemanfaat) {
            $pemanfaat = Pemanfaat::where('kode_pemanfaat', $book->pemanfaat)->first();
        }
        $isFavorited = auth()->check() ? auth()->user()->favorites->contains($book) : false;
        return view('books.show', compact('book', 'isFavorited', 'pemanfaat'));
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
