<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    public function run()
    {
        Jabatan::create([
            'nama_jabatan' => 'Manager',
            'gaji_pokok' => 8000000,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Staff',
            'gaji_pokok' => 5000000,
        ]);

        Jabatan::create([
            'nama_jabatan' => 'Supervisor',
            'gaji_pokok' => 6000000,
        ]);
    }
}
