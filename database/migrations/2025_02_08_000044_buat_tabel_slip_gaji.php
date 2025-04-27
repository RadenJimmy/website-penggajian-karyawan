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
        Schema::create('slip_gaji', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('karyawan_id');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('total_bonus', 15, 2);
            $table->decimal('total_lembur', 15, 2);
            $table->decimal('total_pajak', 15, 2);
            $table->decimal('total_potongan', 15, 2);
            $table->decimal('jumlah_gaji', 15, 2); // Gaji bersih setelah dihitung
            $table->enum('bulan', ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember']);
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('slip_gaji');
    }
};
