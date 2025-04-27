<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusLembur extends Model
{
    use HasFactory;

    protected $table = 'bonus_lembur';
    protected $fillable = ['karyawan_id', 'bonus', 'lembur', 'bulan', 'tahun'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'karyawan_id');
    }
}
