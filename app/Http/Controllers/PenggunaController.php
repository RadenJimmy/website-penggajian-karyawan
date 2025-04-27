<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use App\Models\HakAkses;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::with('hakAkses')->get();
        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        $hakAkses = HakAkses::all();
        return view('pengguna.create', compact('hakAkses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:pengguna',
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'nama' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        $request['password'] = bcrypt($request->password);
        Pengguna::create($request->all());
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $hakAkses = HakAkses::all();
        return view('pengguna.edit', compact('pengguna', 'hakAkses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'hak_akses_id' => 'required|exists:hak_akses,id',
            'nama' => 'required|string',
        ]);

        $pengguna = Pengguna::findOrFail($id);
        if ($request->password) {
            $request['password'] = bcrypt($request->password);
        }
        $pengguna->update($request->all());
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();
        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
