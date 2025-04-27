<?php

namespace App\Http\Controllers;

use App\Models\Potongan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PotonganController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $potongan = Potongan::with('karyawan')
        ->when($search, function ($query, $search) {
            return $query->whereHas('karyawan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })
                ->orWhere('bulan', 'like', "%$search%")
                ->orWhere('tahun', 'like', "%$search%")
                ->orWhere('jumlah_potongan', 'like', "%$search%")
                ->orWhere('keterangan', 'like', "%$search%");
        })
        ->get();

    return view('potongan.index', compact('potongan'));
}


    public function create()
    {
        $karyawan = Karyawan::all();
        return view('potongan.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jumlah_potongan' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        Potongan::create($request->all());
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $potongan = Potongan::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('potongan.edit', compact('potongan', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_potongan' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        $potongan = Potongan::findOrFail($id);
        $potongan->update($request->all());
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $potongan = Potongan::findOrFail($id);
        $potongan->delete();
        return redirect()->route('potongan.index')->with('success', 'Potongan berhasil dihapus!');
    }
}
