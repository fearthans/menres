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
        Schema::create('informasi_aset_kritis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori')->constrained('kategori_aset_kritis')->onDelete('cascade');
            $table->string('name', 255);
            $table->string('deskripsi', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_aset_kritis');
    }
};
