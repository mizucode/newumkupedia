<?php
// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Book extends Model
{
    use HasFactory;

    /**
     * Users who have favorited this book.
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'book_user');
    }
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
        'pemanfaat',
        'nomor_klasifikasi',
        'nomor_panggil',
        'cover_image_path',
        'pdf_path',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


public function pemanfaatRelasi()
{
    return $this->belongsTo(Pemanfaat::class, 'pemanfaat', 'kode_pemanfaat');
}
}
