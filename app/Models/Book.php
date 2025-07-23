<?php
// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'author',
        'description',
        'jumlah_halaman',
        'isbn',
        'tahun_terbit',
        'penerbit',
        'cover_image_path',
        'pdf_path',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
