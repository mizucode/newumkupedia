<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Book $book)
    {
        $user = Auth::user();

        // `toggle` akan menambah jika belum ada, dan menghapus jika sudah ada
        $user->favorites()->toggle($book->id);

        return back()->with('success', 'Status favorit berhasil diubah.');
    }
}