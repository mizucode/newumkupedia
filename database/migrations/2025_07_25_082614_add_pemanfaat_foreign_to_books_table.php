<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            
            $table->foreign('pemanfaat')
                  ->references('kode_pemanfaat')
                  ->on('pemanfaat')
                  ->onDelete('set null')
                  ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropForeign(['pemanfaat']); 

            $table->dropColumn('pemanfaat');
        });
    }
};