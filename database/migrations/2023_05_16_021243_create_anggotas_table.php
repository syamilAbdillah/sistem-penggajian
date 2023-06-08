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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->bigInteger('gaji');
            $table->foreignId('jabatan_id')->constrained('jabatans', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users', 'id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('lokasi_id')->constrained('lokasis', 'id')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};
