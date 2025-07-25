<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestEbookController extends Controller
{
    // Hanya user yang bisa request
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'deskripsi' => 'required|string',
            'alasan' => 'required|string',
        ]);

        \App\Models\RequestEbook::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'alasan' => $request->alasan,
        ]);

        return redirect()->back()->with('success', 'Request buku berhasil dikirim!');
    }
}
