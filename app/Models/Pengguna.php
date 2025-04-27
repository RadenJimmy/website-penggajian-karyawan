<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';
    protected $fillable = ['email', 'hak_akses_id', 'nama', 'password'];

    public function hakAkses()
    {
        return $this->belongsTo(HakAkses::class, 'hak_akses_id');
    }
}
