<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PotonganGaji;
use Illuminate\Http\Request;

class PotonganGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $jabatan_id = $req->query('jabatan_id');
        $jabatan = Jabatan::find($jabatan_id);
        $list_jabatan = Jabatan::all();

        if($jabatan == null) {
            return view('potongan_gaji.form', ['list_jabatan' => $list_jabatan]);
        } else {
            $list_potongan_gaji = PotonganGaji::where('jabatan_id', $jabatan->id)->get();
            return view('potongan_gaji.index', [
                'list_jabatan' => $list_jabatan,
                'jabatan' => $jabatan,
                'list_potongan_gaji' => $list_potongan_gaji,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $list_jabatan = Jabatan::all();
        return view('potongan_gaji.create', ['list_jabatan' => $list_jabatan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan_id' => 'required|exists:'.Jabatan::class.',id',
            'keterangan' => 'required|string',
            'nilai_potongan' => 'required|numeric'
        ]);

        $pg = new PotonganGaji();
        $pg->keterangan = $validated['keterangan'];
        $pg->jabatan_id = $validated['jabatan_id'];
        $pg->nilai_potongan = $validated['nilai_potongan'];
        $pg->save();

        return redirect(route('potongan-gaji.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PotonganGaji $potonganGaji)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PotonganGaji $potonganGaji)
    {
        
        
        $list_jabatan = Jabatan::all();
        return view('potongan_gaji.create', ['list_jabatan' => $list_jabatan, 'potongan_gaji' => $potonganGaji]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PotonganGaji $potonganGaji)
    {
        
        $validated = $request->validate([
            'jabatan_id' => 'required|exists:'.Jabatan::class.',id',
            'keterangan' => 'required|string',
            'nilai_potongan' => 'required|numeric'
        ]);

        $potonganGaji->keterangan = $validated['keterangan'];
        $potonganGaji->jabatan_id = $validated['jabatan_id'];
        $potonganGaji->nilai_potongan = $validated['nilai_potongan'];
        $potonganGaji->save();

        return redirect(route('potongan-gaji.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PotonganGaji $potonganGaji)
    {
        $potonganGaji->delete();
        return redirect(route('potongan-gaji.index'));
    }
}
