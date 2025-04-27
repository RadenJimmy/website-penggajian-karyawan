<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranGaji extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_gaji';

    protected $fillable = [
        'karyawan_id',
        'slip_gaji_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function slipGaji()
{
    return $this->belongsTo(SlipGaji::class, 'slip_gaji_id')->withDefault();
}

}
