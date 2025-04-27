<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\SlipGaji;
use App\Models\PembayaranGaji;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalKaryawan = Karyawan::count();
        $totalSlipGajiDibayar = PembayaranGaji::where('status', 'selesai')->count();
        $totalTransaksi = PembayaranGaji::count();

        // Perbaiki cara mengambil total gaji dibayar dengan menggunakan JOIN
        $totalGajiDibayar = PembayaranGaji::join('slip_gaji', 'pembayaran_gaji.slip_gaji_id', '=', 'slip_gaji.id')
            ->where('pembayaran_gaji.status', 'selesai')
            ->sum('slip_gaji.jumlah_gaji');

        // Ambil Data Gaji Per Bulan
        $bulan = [];
        $pengeluaranGaji = [];
        $currentYear = Carbon::now()->year;

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = Carbon::create()->month($i)->translatedFormat('F');

            // Perbaiki query dengan JOIN agar lebih efisien
            $pengeluaranGaji[] = PembayaranGaji::join('slip_gaji', 'pembayaran_gaji.slip_gaji_id', '=', 'slip_gaji.id')
                ->where('pembayaran_gaji.status', 'selesai')
                ->whereMonth('pembayaran_gaji.created_at', $i)
                ->whereYear('pembayaran_gaji.created_at', $currentYear)
                ->sum('slip_gaji.jumlah_gaji');
        }

        return view('dashboard', compact(
            'totalKaryawan',
            'totalSlipGajiDibayar',
            'totalGajiDibayar',
            'totalTransaksi',
            'bulan',
            'pengeluaranGaji'
        ));
    }
}
