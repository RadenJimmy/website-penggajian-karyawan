<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('laporan_gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Jika karyawan dihapus, laporan juga dihapus
            $table->decimal('jumlah_gaji', 15, 2); // Gaji yang dilaporkan
            $table->decimal('pajak', 15, 2); // Pajak yang dibayarkan
            $table->decimal('bonus', 15, 2); // Bonus yang diterima
            $table->decimal('lembur', 15, 2); // Lembur yang diterima
            $table->decimal('potongan', 15, 2); // Potongan yang diterima
            $table->enum('bulan', [
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
            ]);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('laporan_gaji'); // Perbaikan nama tabel
    }
};
