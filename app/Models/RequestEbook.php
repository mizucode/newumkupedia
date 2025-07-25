<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEbook extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul',
        'penulis',
        'tahun',
        'deskripsi',
        'alasan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
