<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed database.
     */
    public function run()
    {
        $this->call([
            HakAksesSeeder::class,
            UserSeeder::class,
            JabatanSeeder::class,
            KaryawanSeeder::class,
            SlipGajiSeeder::class,
            PotonganSeeder::class,
            PajakPenghasilanSeeder::class,
            BonusLemburSeeder::class,
            IzinSeeder::class,
            LaporanGajiSeeder::class,
            PembayaranGajiSeeder::class,
        ]);
    }
}
