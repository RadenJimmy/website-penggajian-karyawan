<?php

namespace Database\Seeders;

use App\Models\PajakPenghasilan;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class PajakPenghasilanSeeder extends Seeder
{
    public function run()
    {
        PajakPenghasilan::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'jumlah_pajak' => 500000,
            'bulan' => 'Januari',
            'tahun' => 2025,
        ]);

        PajakPenghasilan::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'jumlah_pajak' => 300000,
            'bulan' => 'Februari',
            'tahun' => 2025,
        ]);
    }
}
