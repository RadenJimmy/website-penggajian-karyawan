<?php

namespace Database\Seeders;

use App\Models\Potongan;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class PotonganSeeder extends Seeder
{
    public function run()
    {
        Potongan::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'jumlah_potongan' => 500000,
            'keterangan' => 'Minjem',
            'bulan' => 'Januari',
            'Tahun' => 2025,
        ]);

        Potongan::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'jumlah_potongan' => 300000,
            'keterangan' => 'maling',
            'bulan' => 'Januari',
            'Tahun' => 2025,
        ]);
    }
}
