<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemanfaat extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pemanfaat'; // Pastikan nama tabel sesuai

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_pemanfaat',
        'nama_pemanfaat',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // Jika ada kolom yang perlu di-cast (misal: ke boolean, datetime), tambahkan di sini.
        // Contoh: 'is_active' => 'boolean',
    ];

    // Relasi: satu pemanfaat bisa memiliki banyak buku
    public function books()
    {
        return $this->hasMany(Book::class, 'pemanfaat', 'kode_pemanfaat');
    }
}