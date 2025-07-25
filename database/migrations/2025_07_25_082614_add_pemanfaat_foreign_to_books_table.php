<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migrasi.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            
            $table->foreign('pemanfaat')
                  ->references('kode_pemanfaat')
                  ->on('pemanfaat')
                  ->onDelete('set null') // Jika pemanfaat dihapus, kolom 'pemanfaat' di books akan jadi NULL
                  ->onUpdate('cascade'); // Jika kode_pemanfaat di pemanfaat diupdate, kolom 'pemanfaat' di books akan ikut update
        });
    }

    /**
     * Batalkan migrasi.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // Drop foreign key constraint terlebih dahulu
            $table->dropForeign(['pemanfaat']); // Nama constraint default Laravel: books_pemanfaat_foreign

            // Kemudian drop kolom 'pemanfaat'
            $table->dropColumn('pemanfaat');
        });
    }
};