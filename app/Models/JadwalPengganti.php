<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengganti extends Model
{
    use HasFactory;

    public function jadwal_anggota() 
    {
        return $this->belongsTo(JadwalAnggota::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
