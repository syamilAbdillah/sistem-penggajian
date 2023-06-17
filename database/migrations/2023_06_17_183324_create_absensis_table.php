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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_anggota_id')->references('jadwal_anggotas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('anggota_id')->references('anggotas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('keterangan', ['hadir', 'sakit', 'izin', 'tanpa ket']);
            $table->boolean('pengganti')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
