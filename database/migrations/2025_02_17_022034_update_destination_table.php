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
        Schema::table('destination', function (Blueprint $table) {
            // Menghapus kolom 'image'
            $table->dropColumn('image');

            // Menambahkan kolom 'images' dengan tipe data JSON
            $table->json('images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destination', function (Blueprint $table) {
            // Menambahkan kembali kolom 'image' yang telah dihapus
            $table->string('image')->nullable();

            // Menghapus kolom 'images'
            $table->dropColumn('images');
        });
    }
};
