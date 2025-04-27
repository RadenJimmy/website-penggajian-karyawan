<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PembayaranGaji;
use App\Models\Karyawan;
use App\Models\SlipGaji;
use Carbon\Carbon;

class PembayaranGajiSeeder extends Seeder
{
    public function run()
    {
        $karyawan = Karyawan::all();
        $slipGaji = SlipGaji::all();

        if ($karyawan->isEmpty() || $slipGaji->isEmpty()) {
            $this->command->info('Tidak ada data Karyawan atau Slip Gaji, jalankan seeder untuk karyawan dan slip gaji terlebih dahulu.');
            return;
        }

        foreach ($karyawan as $k) {
            $slip = $slipGaji->where('karyawan_id', $k->id)->first();

            if ($slip) {
                PembayaranGaji::create([
                    'karyawan_id' => $k->id,
                    'slip_gaji_id' => $slip->id,
                    'tanggal_pembayaran' => Carbon::now()->subDays(rand(1, 30)),
                    'metode_pembayaran' => ['Transfer Bank', 'Tunai', 'E-Wallet'][rand(0, 2)],
                    'status' => ['pending', 'selesai'][rand(0, 1)],
                ]);
            }
        }

        $this->command->info('Seeder Pembayaran Gaji berhasil ditambahkan!');
    }
}
