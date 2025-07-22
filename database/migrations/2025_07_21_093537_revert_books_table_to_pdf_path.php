<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('total_pages');
            $table->renameColumn('pages_directory', 'pdf_path');
        });
    }
    public function down(): void {
        Schema::table('books', function (Blueprint $table) {
            $table->integer('total_pages')->default(0);
            $table->renameColumn('pdf_path', 'pages_directory');
        });
    }
};