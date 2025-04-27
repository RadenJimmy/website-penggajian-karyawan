<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use Illuminate\Http\Request;

class HakAksesController extends Controller
{
    public function index()
    {
        $hakAkses = HakAkses::all();
        return view('hak_akses.index', compact('hakAkses'));
    }

    public function create()
    {
        return view('hak_akses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hak_akses' => 'required|string|unique:hak_akses',
        ]);

        HakAkses::create($request->all());
        return redirect()->route('hak_akses.index')->with('success', 'Hak Akses berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        return view('hak_akses.edit', compact('hakAkses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_hak_akses' => 'required|string',
        ]);

        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->update($request->all());
        return redirect()->route('hak_akses.index')->with('success', 'Hak Akses berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $hakAkses = HakAkses::findOrFail($id);
        $hakAkses->delete();
        return redirect()->route('hak_akses.index')->with('success', 'Hak Akses berhasil dihapus!');
    }
}
