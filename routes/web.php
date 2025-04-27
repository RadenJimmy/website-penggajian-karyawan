<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PembayaranGajiController;
use App\Http\Controllers\{
    HakAksesController,
    PenggunaController,
    JabatanController,
    KaryawanController,
    SlipGajiController,
    PotonganController,
    LaporanGajiController,
    PajakPenghasilanController,
    BonusLemburController
};

// Halaman Utama
Route::get('/', function () {
    return redirect('/login');
});

// **Rute Login & Logout**
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// **Rute untuk Admin**
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('hak-akses', HakAksesController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('jabatan', JabatanController::class);
    Route::resource('karyawan', KaryawanController::class);
    Route::get('karyawan/generate-nik', [KaryawanController::class, 'generateNIK']);
    Route::post('/karyawan/import', [KaryawanController::class, 'import'])->name('karyawan.import');
    Route::resource('slip_gaji', SlipGajiController::class);
    Route::get('/slip_gaji/download-all', [SlipGajiController::class, 'exportAllPDF'])->name('slip_gaji.downloadAll');
    Route::get('slip_gaji/{id}/download', [SlipGajiController::class, 'downloadPDF'])->name('slip_gaji.downloadPDF');
    Route::resource('potongan', PotonganController::class);
    Route::resource('laporan-gaji', LaporanGajiController::class);
    Route::resource('pajak_penghasilan', PajakPenghasilanController::class);
    Route::resource('bonus_lembur', BonusLemburController::class);
    Route::get('/pembayaran_gaji/export', [PembayaranGajiController::class, 'exportExcel'])->name('pembayaran_gaji.exportExcel');
    Route::resource('pembayaran_gaji', PembayaranGajiController::class);
    Route::get('/get-slip-gaji/{karyawan_id}', [PembayaranGajiController::class, 'getSlipGajiByKaryawan']);
    Route::post('pembayaran_gaji/{id}/update-status', [PembayaranGajiController::class, 'updateStatus'])->name('pembayaran_gaji.updateStatus');
});

// **Rute untuk Karyawan**
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
