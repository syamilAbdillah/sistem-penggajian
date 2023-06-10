<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AnggotaJadwalController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JadwalHarianController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();

    if($user == null) {
        return redirect('/login');
    }

    if($user->role == 'admin') {
        return redirect('/admin');
    }

    if($user->role == 'anggota') {
        return redirect('/anggota');
    }

    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('/admin')->middleware('admin_only')->group(function() {
        Route::get('/', function () {
            return view('root.admin');
        });
        Route::resource('lokasi', LokasiController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('anggota', AnggotaController::class);
        Route::resource('jadwal', JadwalController::class);
        Route::resource('jadwal-harian', JadwalHarianController::class)->only('update');
    });

    Route::prefix('/anggota')->middleware('anggota_only')->group(function() {
        Route::get('/', function() {
            return view('root.anggota');
        });

        Route::resource('jadwal-anggota', AnggotaJadwalController::class);

    });

});

require __DIR__.'/auth.php';
