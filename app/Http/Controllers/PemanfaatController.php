<?php

namespace App\Http\Controllers;

use App\Models\Pemanfaat; // Impor model Pemanfaat
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PemanfaatController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $query = \App\Models\Pemanfaat::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where(function($q) use ($search) {
            $q->where('kode_pemanfaat', 'like', "%{$search}%")
              ->orWhere('nama_pemanfaat', 'like', "%{$search}%");
        });
    }

    $pemanfaats = $query->latest()->paginate(10)->withQueryString();
    return view('admin.books.pemanfaat.index', compact('pemanfaats'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.books.pemanfaat.create'); // Menampilkan form untuk membuat pemanfaat baru
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_pemanfaat' => ['required', 'string', 'max:255', Rule::unique('pemanfaat', 'kode_pemanfaat')],
            'nama_pemanfaat' => 'required|string|max:255',
        ]);

        Pemanfaat::create($request->all()); // Membuat pemanfaat baru dari data request

        return redirect()->route('admin.pemanfaat.index') // Redirect kembali ke halaman daftar pemanfaat
                         ->with('success', 'Pemanfaat berhasil ditambahkan!'); // Pesan sukses
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemanfaat $pemanfaat) // Menggunakan Route Model Binding
    {
        return view('admin.pemanfaat.show', compact('pemanfaat')); // Menampilkan detail pemanfaat
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemanfaat $pemanfaat) // Menggunakan Route Model Binding
    {
        return view('admin.books.pemanfaat.edit', compact('pemanfaat')); // Menampilkan form edit pemanfaat
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemanfaat $pemanfaat) // Menggunakan Route Model Binding
    {
        $request->validate([
            'kode_pemanfaat' => ['required', 'string', 'max:255', Rule::unique('pemanfaat', 'kode_pemanfaat')->ignore($pemanfaat->id)],
            'nama_pemanfaat' => 'required|string|max:255',
        ]);

        $pemanfaat->update($request->all()); // Memperbarui data pemanfaat

        return redirect()->route('admin.pemanfaat.index')
                         ->with('success', 'Pemanfaat berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemanfaat $pemanfaat) // Menggunakan Route Model Binding
    {
        $pemanfaat->delete(); // Menghapus pemanfaat

        return redirect()->route('admin.pemanfaat.index')
                         ->with('success', 'Pemanfaat berhasil dihapus!');
    }
}