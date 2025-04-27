<?php

namespace App\Http\Controllers;

use App\Models\PajakPenghasilan;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class PajakPenghasilanController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $pajakPenghasilan = PajakPenghasilan::with('karyawan')
        ->when($search, function ($query, $search) {
            return $query->whereHas('karyawan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })
                ->orWhere('bulan', 'like', "%$search%")
                ->orWhere('tahun', 'like', "%$search%")
                ->orWhere('jumlah_pajak', 'like', "%$search%");
        })
        ->get();

    return view('pajak_penghasilan.index', compact('pajakPenghasilan'));
}

    public function create()
    {
        $karyawan = Karyawan::all();
        return view('pajak_penghasilan.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jumlah_pajak' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        PajakPenghasilan::create($request->all());
        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pajakPenghasilan = PajakPenghasilan::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('pajak_penghasilan.edit', compact('pajakPenghasilan', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_pajak' => 'required|numeric',
        ]);

        $pajakPenghasilan = PajakPenghasilan::findOrFail($id);
        $pajakPenghasilan->update($request->all());
        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pajakPenghasilan = PajakPenghasilan::findOrFail($id);
        $pajakPenghasilan->delete();
        return redirect()->route('pajak_penghasilan.index')->with('success', 'Pajak Penghasilan berhasil dihapus!');
    }
}
