<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\JadwalAnggota;
use App\Models\Periode;
use Illuminate\Http\Request;

class JadwalAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            "anggota_id" => "required|exists:".Anggota::class.",id",
            "periode_id" => "required|exists:".Periode::class.",id",
            "tanggal" => "required|date",
            "shift" => "required|in:pagi,siang,malam",
        ]);

        $ja = new JadwalAnggota();
        $ja->anggota_id = $request->input('anggota_id');
        $ja->periode_id = $request->input('periode_id');
        $ja->tanggal = $request->input('tanggal');
        $ja->shift = $request->input('shift');
        $ja->save();

        $periode = Periode::find($ja->periode->id);

        return redirect(route("jadwal.show", ["jadwal" => $periode]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, JadwalAnggota $jadwal_anggotum)
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
