<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Anggota;
use App\Models\Periode;
use DateTime, DateTimeZone;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_jadwal = Periode::orderByDesc('dari')->get();

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
        $validated = $request->validate([
            'bulan' => 'required|string'
        ]);


        $timezone = new DateTimeZone('Asia/Jakarta');
        $strtime = strtotime($validated['bulan']);
        $date = date("Y-m-d", $strtime);
        $dateTime = new DateTime($date, $timezone);

        $dateTime->modify("first day of this month");
        $dari = $dateTime->format("Y-m-d");

        $dateTime->modify("last day of this month");
        $hingga = $dateTime->format("Y-m-d");


        $periode = new Periode();
        $periode->dari = $dari;
        $periode->hingga = $hingga;
        $periode->save();

        return $this->index();
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $jadwal)
    {
        $periode = $jadwal;

        $list_anggota = Anggota::with([
            'jadwal' => function($query) use ($periode) {
                $query->where('periode_id', $periode->id);
            },
            'user' => function($query) {
                $query->orderBy('nama');
            },
        ])->get();


        return view('jadwal.show', [
            'list_anggota' => $list_anggota,
            'periode' => $periode,
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
