<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Periode;
use App\Models\JadwalAnggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list_jadwal = Periode::orderByDesc('dari')->get();
        return view('jadwal_absensi.index', [
            'list_jadwal' => $list_jadwal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Periode $jadwal_absensi)
    {
        $anggota = Anggota::where('user_id', Auth::user()->id)->first();

        $list_jadwal_anggota = JadwalAnggota::where([
            ['periode_id', $jadwal_absensi->id],
            ['anggota_id', $anggota->id],
        ])->get();

        return view('jadwal_absensi.show', [
            "jadwal" => $jadwal_absensi,
            "anggota" => $anggota,
            "list_jadwal_anggota" => $list_jadwal_anggota,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
