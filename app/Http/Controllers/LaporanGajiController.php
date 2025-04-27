<?php

namespace App\Http\Controllers;

use App\Models\LaporanGaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class LaporanGajiController extends Controller
{
    public function index()
    {
        $laporanGaji = LaporanGaji::with('karyawan')->get();
        return view('laporan_gaji.index', compact('laporanGaji'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('laporan_gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jumlah_gaji' => 'required|numeric',
            'pajak' => 'required|numeric',
            'bonus' => 'required|numeric',
            'lembur' => 'required|numeric',
            'potongan' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        LaporanGaji::create($request->all());
        return redirect()->route('laporan_gaji.index')->with('success', 'Laporan Gaji berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $laporanGaji = LaporanGaji::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('laporan_gaji.edit', compact('laporanGaji', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_gaji' => 'required|numeric',
        ]);

        $laporanGaji = LaporanGaji::findOrFail($id);
        $laporanGaji->update($request->all());
        return redirect()->route('laporan_gaji.index')->with('success', 'Laporan Gaji berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $laporanGaji = LaporanGaji::findOrFail($id);
        $laporanGaji->delete();
        return redirect()->route('laporan_gaji.index')->with('success', 'Laporan Gaji berhasil dihapus!');
    }
}
