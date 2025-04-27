<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pembayaran_gaji', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawan')->onDelete('cascade'); // Jika karyawan dihapus, pembayaran ikut terhapus
            $table->foreignId('slip_gaji_id')->constrained('slip_gaji')->onDelete('cascade'); // Jika slip gaji dihapus, pembayaran ikut terhapus
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran');
            $table->enum('status', ['pending', 'selesai'])->default('pending'); // Default status 'pending'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran_gaji');
    }
};
