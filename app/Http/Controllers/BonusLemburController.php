<?php

namespace App\Http\Controllers;

use App\Models\BonusLembur;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class BonusLemburController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $bonusLembur = BonusLembur::with('karyawan')
        ->when($search, function ($query, $search) {
            return $query->whereHas('karyawan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })
                ->orWhere('bulan', 'like', "%$search%")
                ->orWhere('tahun', 'like', "%$search%")
                ->orWhere('bonus', 'like', "%$search%")
                ->orWhere('lembur', 'like', "%$search%");
        })
        ->get();

    return view('bonus_lembur.index', compact('bonusLembur'));
}


    public function create()
    {
        $karyawan = Karyawan::all();
        return view('bonus_lembur.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bonus' => 'required|numeric',
            'lembur' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        BonusLembur::create($request->all());
        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $bonusLembur = BonusLembur::findOrFail($id);
        $karyawan = Karyawan::all();
        return view('bonus_lembur.edit', compact('bonusLembur', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bonus' => 'required|numeric',
            'lembur' => 'required|numeric',
        ]);

        $bonusLembur = BonusLembur::findOrFail($id);
        $bonusLembur->update($request->all());
        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $bonusLembur = BonusLembur::findOrFail($id);
        $bonusLembur->delete();
        return redirect()->route('bonus_lembur.index')->with('success', 'Bonus dan Lembur berhasil dihapus!');
    }
}
