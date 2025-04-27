<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanGaji extends Model
{
    use HasFactory;

    protected $table = 'laporan_gaji';
    protected $fillable = ['karyawan_id', 'jumlah_gaji', 'pajak', 'bonus', 'lembur', 'potongan', 'bulan', 'tahun'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
