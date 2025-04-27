<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan'; // Menentukan nama tabel secara eksplisit
    protected $fillable = ['nama_jabatan', 'gaji_pokok'];

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'jabatan_id');
    }
}
