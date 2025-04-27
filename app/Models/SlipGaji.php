<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{
    use HasFactory;

    protected $table = 'slip_gaji';
    protected $fillable = [
        'karyawan_id',
        'gaji_pokok',
        'total_bonus',
        'total_lembur',
        'total_pajak',
        'total_potongan',
        'jumlah_gaji',
        'bulan',
        'tahun'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }

    public function pembayaranGaji()
    {
        return $this->hasOne(PembayaranGaji::class, 'slip_gaji_id');
    }
}
