<?php

namespace Database\Seeders;
use App\Models\LaporanGaji;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class LaporanGajiSeeder extends Seeder
{
    public function run()
    {
        LaporanGaji::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'jumlah_gaji' => 6000000,
            'pajak' => 500000,
            'bonus' => 1000000,
            'lembur' => 500000,
            'potongan' => 500000,
            'bulan' => 'Januari',
            'tahun' => 2025,
        ]);

        LaporanGaji::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'jumlah_gaji' => 5250000,
            'pajak' => 300000,
            'bonus' => 500000,
            'lembur' => 250000,
            'potongan' => 300000,
            'bulan' => 'Februari',
            'tahun' => 2025,
        ]);
    }
}
