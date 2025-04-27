<?php

namespace Database\Seeders;

use App\Models\SlipGaji;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class SlipGajiSeeder extends Seeder
{
    public function run()
    {
        SlipGaji::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'gaji_pokok' => 5000000,
            'total_bonus' => 1000000,
            'total_lembur' => 500000,
            'total_pajak' => 500000,
            'total_potongan' => 500000,
            'jumlah_gaji' => 6000000, // gaji bersih
            'bulan' => 'Januari',
            'tahun' => 2025,
        ]);

        SlipGaji::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'gaji_pokok' => 5000000,
            'total_bonus' => 500000,
            'total_lembur' => 250000,
            'total_pajak' => 300000,
            'total_potongan' => 300000,
            'jumlah_gaji' => 5250000, // gaji bersih
            'bulan' => 'Februari',
            'tahun' => 2025,
        ]);
    }
}
