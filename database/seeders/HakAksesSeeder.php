<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    public function run()
    {
        DB::table('hak_akses')->insert([
            ['nama_hak_akses' => 'Admin'],
            ['nama_hak_akses' => 'Karyawan'],
        ]);
    }
}
