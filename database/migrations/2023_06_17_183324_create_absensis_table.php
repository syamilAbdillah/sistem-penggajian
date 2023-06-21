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
            $table->foreignId('jadwal_anggota_id')->constrained('jadwal_anggotas')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('keterangan', ['hadir', 'sakit', 'izin']);
            $table->timestamp('jam_masuk');
            $table->timestamp('jam_keluar');
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
