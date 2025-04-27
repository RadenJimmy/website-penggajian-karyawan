<?php

namespace Database\Seeders;

use App\Models\BonusLembur;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class BonusLemburSeeder extends Seeder
{
    public function run()
    {
        BonusLembur::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'bonus' => 1000000,
            'lembur' => 500000,
            'bulan' => 'Januari',
            'tahun' => 2025,
        ]);

        BonusLembur::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'bonus' => 500000,
            'lembur' => 250000,
            'bulan' => 'Februari',
            'tahun' => 2025,
        ]);
    }
}
