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
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwals', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('anggotas', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('tanggal');
            $table->enum('shift', ['pagi', 'siang', 'malam', 'off']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_harians');
    }
};
