<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $fillable = ['nama', 'nik', 'alamat', 'email', 'telepon', 'jabatan_id'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function slipGaji()
    {
        return $this->hasMany(SlipGaji::class, 'karyawan_id');
    }

    public function potongan()
    {
        return $this->hasMany(Potongan::class, 'karyawan_id');
    }

    public function bonusLembur()
    {
        return $this->hasMany(BonusLembur::class, 'karyawan_id');
    }

    public function pajakPenghasilan()
    {
        return $this->hasMany(PajakPenghasilan::class, 'karyawan_id');
    }

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'karyawan_id');
    }
}
