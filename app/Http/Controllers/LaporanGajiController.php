<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Periode;
use Illuminate\Http\Request;
use \PDF;

class LaporanGajiController extends Controller
{
    public function index()
    {

        $list_periode = Periode::all();
        return view('laporan_gaji.index', [
            'list_periode' => $list_periode,
        ]);
    } 

    public function generate(Request $req)
    {
        $validated = $req->validate([
            'periode_id' => 'requried|exisits:'.Periode::class.',id',
        ]);

        $jadwal = Jadwal::with('anggota', 'anggota.user', 'anggota.jabatan', 'absensi', 'jadwal_pengganti');

        $pdf = \PDF::loadView('laporan_gaji.report');
        return $pdf->download('laporan_gaji.pdf');
    }
}
