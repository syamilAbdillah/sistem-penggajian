<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalHarian extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'jadwal_id', 'anggota_id', 'shift'];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
