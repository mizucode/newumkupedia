<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Menghapus kolom 'penulis'
            $table->dropColumn('penulis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Jika Anda perlu 'mengembalikan' kolom 'penulis' saat rollback
            // Sesuaikan tipe data dan properti lainnya sesuai definisi awal Anda
            $table->string('penulis')->nullable()->after('jumlah_halaman');
        });
    }
};