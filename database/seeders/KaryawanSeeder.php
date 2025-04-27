<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Jabatan;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    public function run()
    {
        Karyawan::create([
            'nik' => 11102074,
            'nama' => 'John Doe',
            'alamat' => 'Jl. Merdeka No. 1',
            'email' => 'johndoe@example.com',
            'telepon' => '081234567890',
            'jabatan_id' => Jabatan::where('nama_jabatan', 'Manager')->first()->id,
        ]);

        Karyawan::create([
            'nik' => 11102075,
            'nama' => 'Jane Smith',
            'alamat' => 'Jl. Kebon Jeruk No. 5',
            'email' => 'janesmith@example.com',
            'telepon' => '081234567891',
            'jabatan_id' => Jabatan::where('nama_jabatan', 'Staff')->first()->id,
        ]);
    }
}
