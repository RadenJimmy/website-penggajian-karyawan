<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanAnalitik extends Model
{
    use HasFactory;

    protected $table = 'laporan_analitik';
    protected $fillable = ['periode', 'total_pengeluaran', 'total_gaji', 'total_bonus', 'total_pajak', 'total_potongan'];
}
