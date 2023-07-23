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
        Schema::create('absensi_pengganti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_pengganti_id')->constrained('jadwal_pengganti', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->string('bukti_kehadiran');
            $table->datetime('jam_masuk');
            $table->datetime('jam_keluar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_penggantis');
    }
};
