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
        Schema::create('jadwal_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('periode_id')->constrained('periodes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('anggotas')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('shift', ['pagi', 'siang', 'malam']);
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_anggotas');
    }
};