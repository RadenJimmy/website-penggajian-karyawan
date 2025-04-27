<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PajakPenghasilan extends Model
{
    use HasFactory;

    protected $table = 'pajak_penghasilan';
    protected $fillable = ['karyawan_id', 'jumlah_pajak', 'bulan', 'tahun'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
