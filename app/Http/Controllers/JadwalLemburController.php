<?php

namespace App\Http\Controllers;

use App\Models\AbsensiPengganti;
use App\Models\Jadwal;
use App\Models\JadwalPengganti;
use App\Models\Periode;
use Illuminate\Http\Request;

use DateTime, DateTimeZone, DateInterval;

class JadwalLemburController extends Controller
{
    public function index(Request $req)
    {
        $periode_id  = $req->query('periode_id');
        $periode = Periode::find($periode_id);
        $list_periode = Periode::all();

        if ($periode != null) {
            $list_jadwal_pengganti = JadwalPengganti::with('jadwal', 'jadwal.anggota', 'jadwal.anggota.user', 'anggota', 'absensi_pengganti')->get();

            return view('jadwal_lembur.index', [
                'list_periode' => $list_periode,
                'list_jadwal_pengganti' => $list_jadwal_pengganti,
            ]);
        } else {
            return view('jadwal_lembur.form', [
                'list_periode' => $list_periode,
            ]);
        }

    }
    public function create(JadwalPengganti $jadwal_pengganti) {
        $jadwal = Jadwal::with('jadwal_pengganti', 'anggota', 'anggota.user')->where('id', $jadwal_pengganti->jadwal_id)->first();

        return view('jadwal_lembur.create', ['jadwal' => $jadwal]);
    } 

    public function store(Request $req, JadwalPengganti $jadwal_pengganti)
    {

        $req->validate([
            'bukti_kehadiran' => 'required|image|max:2048'
        ]);



        $timezone = new DateTimeZone('Asia/Jakarta');
        $now = new DateTime('now', $timezone);
        $interval = DateInterval::createFromDateString('8 hours');

        $filename = $req->file('bukti_kehadiran')->store();

        $ap = new AbsensiPengganti();
        $ap->jadwal_pengganti_id = $jadwal_pengganti->id;
        $ap->bukti_kehadiran = "/storage/".$filename;
        $ap->jam_masuk = $now->getTimestamp();
        $ap->jam_keluar = $now->add($interval)->getTimestamp();
        $ap->save();

        return redirect(route('list-jadwal-lembur'));
    }
}