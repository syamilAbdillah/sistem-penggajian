<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Anggota;
use App\Models\JadwalHarian;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_jadwal = Jadwal::orderByDesc('bulan')->get();

        return view('jadwal.index', [
            'list_jadwal' => $list_jadwal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // TODO:
        //      - should be validated !!

        $jadwal = new Jadwal();
        $jadwal->bulan = $request->input('bulan');
        $jadwal->save();

        $year = date("Y", strtotime($jadwal->bulan));
        $month = date("m", strtotime($jadwal->bulan));

        $entries = [];

        $total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);


        $all_anggota = Anggota::all();

        foreach($all_anggota as $anggota) {
            for($d = 1; $d <= $total_day; $d++) {
                $jh = [
                    "jadwal_id" => $jadwal->id,
                    "anggota_id" => $anggota->id,
                    "tanggal" => $d,
                    "shift" => 'off',
                ];

                array_push($entries, $jh);
            }
        }

        JadwalHarian::insert($entries);

        $all = JadwalHarian::all();
        ddd($all);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        $year = date("Y", strtotime($jadwal->bulan));
        $month = date("m", strtotime($jadwal->bulan));

        $total_day = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $jadwal_anggota = Anggota::with([
            'jadwal_harian' => function($query) use ($jadwal) {
                $query->where('jadwal_id', $jadwal->id)->orderBy('tanggal');
            }, 
            'user' => function($query) {
                $query->orderBy('nama');
            },
        ])->get();

        return view('jadwal.show', [
            'jadwal_anggota' => $jadwal_anggota, 
            'total_day' => $total_day,
            'jadwal' => $jadwal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
