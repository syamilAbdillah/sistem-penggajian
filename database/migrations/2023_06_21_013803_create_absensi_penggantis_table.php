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
        Schema::create('absensi_penggantis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_pengganti_id')->constrained('jadwal_penggantis')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('anggota_id')->constrained('anggotas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete()->cascadeOnUpdate();
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
