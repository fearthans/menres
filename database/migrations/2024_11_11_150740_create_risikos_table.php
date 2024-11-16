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
        Schema::create('risikos', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('id_aset')->constrained('informasi_aset_kritis')->onDelete('cascade');
            $table->string('kerentanan');
            $table->string('ancaman');
            $table->string('potensi_sebab');
            $table->string('potensi_efek');
            $table->integer('severity');
            $table->integer('occurrence');
            $table->integer('detection');
            $table->string('mitigation')->nullable();
            $table->datetime('mitigation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risikos');
    }
};
