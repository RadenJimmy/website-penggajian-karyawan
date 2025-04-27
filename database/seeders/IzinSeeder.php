<?php

namespace Database\Seeders;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;

class IzinSeeder extends Seeder
{
    public function run()
    {
        Izin::create([
            'karyawan_id' => Karyawan::where('nama', 'John Doe')->first()->id,
            'tanggal' => '2025-02-07',
            'alasan' => 'Sakit',
            'status' => 'disetujui',
        ]);

        Izin::create([
            'karyawan_id' => Karyawan::where('nama', 'Jane Smith')->first()->id,
            'tanggal' => '2025-02-15',
            'alasan' => 'Kepentingan Pribadi',
            'status' => 'disetujui',
        ]);
    }
}
