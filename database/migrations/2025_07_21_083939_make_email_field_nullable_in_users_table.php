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
        Schema::table('users', function (Blueprint $table) {
            // Ubah kolom email agar bisa NULL (nullable) dan tidak lagi unik
            // karena kita akan mengisinya dengan null. Keunikan ada di 'username'.
            $table->string('email')->nullable()->unique(false)->change();
            $table->timestamp('email_verified_at')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan seperti semula jika migrasi di-rollback
            // Pastikan tidak ada data NULL sebelum menjalankan ini di production
            $table->string('email')->nullable(false)->unique()->change();
            $table->timestamp('email_verified_at')->nullable()->change();
        });
    }
};