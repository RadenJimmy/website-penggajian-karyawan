<?php
namespace App\Imports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KaryawanImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Karyawan([
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'alamat' => $row['alamat'],
            'email' => $row['email'],
            'telepon' => $row['telepon'],
            'jabatan_id' => $row['jabatan_id'],
        ]);
    }
}
