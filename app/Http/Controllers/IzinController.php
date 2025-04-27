<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class IzinController extends Controller
{
    public function index()
    {
        $izin = Izin::with('karyawan')->get();
        return view('izin.index', compact('izin'));
    }

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('izin.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            'alasan' => 'required|string',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        Izin::create($request->all());
        return redirect()->route('izin.index')->with('success', 'Izin berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('izin.edit', compact('izin', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        $izin = Izin::findOrFail($id);
        $izin->update($request->all());
        return redirect()->route('izin.index')->with('success', 'Izin berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $izin = Izin::findOrFail($id);
        $izin->delete();
        return redirect()->route('izin.index')->with('success', 'Izin berhasil dihapus!');
    }
}
