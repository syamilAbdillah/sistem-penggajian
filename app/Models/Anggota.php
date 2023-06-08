<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    public function jadwal_harian()
    {
        return $this->hasMany(JadwalHarian::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
}
