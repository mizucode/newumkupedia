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
        Schema::create('pemanfaat', function (Blueprint $table) {
            $table->id(); // Ini akan membuat kolom 'id' sebagai primary key (BIGINT UNSIGNED AUTO_INCREMENT)
            $table->string('kode_pemanfaat')->unique(); // Kolom 'kode_pemanfaat' dengan tipe string dan harus unik
            $table->string('nama_pemanfaat'); // Kolom 'nama_pemanfaat' dengan tipe string
            $table->timestamps(); // Ini akan membuat kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemanfaat'); // Ini akan menghapus tabel 'pemanfaat' jika di-rollback
    }
};