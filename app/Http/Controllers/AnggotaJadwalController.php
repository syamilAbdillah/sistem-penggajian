<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\JadwalHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaJadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $month = date('Y-m');

        $jadwal_harian = JadwalHarian::with([
            'anggota' => function($query) use ($user) {
                $query->where('user_id', $user->id);
            },
            'jadwal' => function($query) use ($month) {
                $query->where('bulan', $month);
            },
        ])->get();      

        ddd($jadwal_harian);

        return view('anggota_jadwal.index');
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
