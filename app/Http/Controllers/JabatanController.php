<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $jabatan = Jabatan::when($search, function ($query, $search) {
            return $query->where('nama_jabatan', 'like', "%$search%");
        })->get();
        
        return view('jabatan.index', compact('jabatan'));
    }

    public function create()
    {
        return view('jabatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|unique:jabatan',
            'gaji_pokok' => 'required|numeric',
        ]);

        Jabatan::create($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        return view('jabatan.edit', compact('jabatan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jabatan' => 'required|string',
            'gaji_pokok' => 'required|numeric',
        ]);

        $jabatan = Jabatan::findOrFail($id);
        $jabatan->update($request->all());
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $jabatan->delete();
        return redirect()->route('jabatan.index')->with('success', 'Jabatan berhasil dihapus!');
    }
}
