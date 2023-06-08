<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Jabatan;
use App\Models\Lokasi;
use App\Models\Anggota;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $init = new User();
        $init->nama = 'test admin';
        $init->email = 'test@email.com';
        $init->password = Hash::make('password');
        $init->role = 'admin';
        $init->save();

        $initLokasi = new Lokasi();
        $initLokasi->nama_lokasi = 'smb';
        $initLokasi->alamat = 'summarecon mall bekasi';
        $initLokasi->save();

        $initJabatan = new Jabatan();
        $initJabatan->nama_jabatan = 'anggota';
        $initJabatan->save();

        $initUserAnggota = new User();
        $initUserAnggota->nama = 'joko cupid';
        $initUserAnggota->email = 'joko@cupid.com';
        $initUserAnggota->password = Hash::make('password');
        $initUserAnggota->role = 'anggota';
        $initUserAnggota->save();

        $initAnggota = new Anggota();
        $initAnggota->gaji = 8000000;
        $initAnggota->nik = '202308080001';
        $initAnggota->user_id = $initUserAnggota->id;
        $initAnggota->jabatan_id = $initJabatan->id;
        $initAnggota->lokasi_id = $initLokasi->id;
        $initAnggota->save();



        $initMegaChan = new User();
        $initMegaChan->nama = 'mega chan';
        $initMegaChan->email = 'mega@xdonut.com';
        $initMegaChan->password = Hash::make('password');
        $initMegaChan->role = 'anggota';
        $initMegaChan->save();

        $initMega = new Anggota();
        $initMega->gaji = 8000000;
        $initMega->nik = '202308080002';
        $initMega->user_id = $initMegaChan->id;
        $initMega->jabatan_id = $initJabatan->id;
        $initMega->lokasi_id = $initLokasi->id;
        $initMega->save();



        $initPuanSama = new User();
        $initPuanSama->nama = 'puan sama';
        $initPuanSama->email = 'puan@xdonut.com';
        $initPuanSama->password = Hash::make('password');
        $initPuanSama->role = 'anggota';
        $initPuanSama->save();

        $initPuan = new Anggota();
        $initPuan->gaji = 8000000;
        $initPuan->nik = '202308080003';
        $initPuan->user_id = $initPuanSama->id;
        $initPuan->jabatan_id = $initJabatan->id;
        $initPuan->lokasi_id = $initLokasi->id;
        $initPuan->save();

    }
}
