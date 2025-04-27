<?php

namespace App\Http\Controllers;

use App\Models\PembayaranGaji;
use App\Models\SlipGaji;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PembayaranGajiExport;


class PembayaranGajiController extends Controller
{
    public function index(Request $request)
    {
        $query = PembayaranGaji::with(['karyawan', 'slipGaji']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('karyawan', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            })->orWhere('metode_pembayaran', 'like', "%$search%")
                ->orWhere('status', 'like', "%$search%");
        }

        $pembayaranGaji = $query->get();

        return view('pembayaran_gaji.index', compact('pembayaranGaji'));
    }
    public function create(Request $request)
    {
        $karyawan = Karyawan::with('jabatan')->get();
        $slipGaji = collect(); // Default kosong

        if ($request->has('karyawan_id')) {
            $slipGaji = SlipGaji::where('karyawan_id', $request->karyawan_id)
                ->whereDoesntHave('pembayaranGaji') // Pastikan slip belum dibayar
                ->get();
        }

        return view('pembayaran_gaji.create', compact('karyawan', 'slipGaji'));
    }
    public function getSlipGajiByKaryawan($karyawan_id)
    {
        $slipGaji = SlipGaji::where('karyawan_id', $karyawan_id)
            ->whereDoesntHave('pembayaranGaji') // Pastikan slip belum dibayar
            ->get();

        return response()->json($slipGaji);
    }
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'slip_gaji_id' => 'required|exists:slip_gaji,id',
            'tanggal_pembayaran' => 'required|date',
            'metode_pembayaran' => 'required|string',
            'status' => 'required|string|in:pending,selesai',
        ]);

        PembayaranGaji::create($request->all());

        return redirect()->route('pembayaran_gaji.index')->with('success', 'Pembayaran Gaji berhasil disimpan!');
    }
    public function show($id)
    {
        $pembayaran = PembayaranGaji::with(['karyawan', 'slipGaji'])->findOrFail($id);

        if (!$pembayaran->slipGaji) {
            return redirect()->route('pembayaran_gaji.index')->with('error', 'Slip gaji tidak ditemukan!');
        }

        return view('pembayaran_gaji.show', compact('pembayaran'));
    }
    public function updateStatus(Request $request, $id)
    {
        $pembayaran = PembayaranGaji::findOrFail($id);
        $pembayaran->update(['status' => 'selesai']);

        return redirect()->route('pembayaran_gaji.index')->with('success', 'Status Pembayaran telah diperbarui!');
    }
    public function destroy($id)
    {
        PembayaranGaji::findOrFail($id)->delete();
        return redirect()->route('pembayaran_gaji.index')->with('success', 'Pembayaran Gaji berhasil dihapus!');
    }
    public function exportExcel()
    {
        return Excel::download(new PembayaranGajiExport, 'laporan_pembagian_gaji.xlsx');
    }
}
