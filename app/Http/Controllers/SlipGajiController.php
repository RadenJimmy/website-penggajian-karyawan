<?php

namespace App\Http\Controllers;

use App\Models\SlipGaji;
use App\Models\Karyawan;
use App\Models\BonusLembur;
use App\Models\PajakPenghasilan;
use App\Models\Cuti;
use App\Models\Potongan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class SlipGajiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bulan = $request->input('bulan');
        $sort = $request->input('sort', 'desc'); 

        $slipGaji = SlipGaji::with('karyawan')
            ->when($bulan, function ($query, $bulan) {
                return $query->where('bulan', $bulan);
            })
            ->when($search, function ($query, $search) {
                return $query->whereHas('karyawan', function ($q) use ($search) {
                    $q->where('nama', 'like', "%$search%");
                })
                    ->orWhere('tahun', 'like', "%$search%")
                    ->orWhere('jumlah_gaji', 'like', "%$search%");
            })
            ->orderBy('jumlah_gaji', $sort) // Sorting berdasarkan total gaji
            ->paginate(10);

        return view('slip_gaji.index', compact('slipGaji'));
    }



    public function create()
    {
        $karyawan = Karyawan::all();
        return view('slip_gaji.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
        ]);

        // Cek apakah sudah ada slip gaji untuk bulan & tahun ini
        $existingSlip = SlipGaji::where('karyawan_id', $request->karyawan_id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        if ($existingSlip) {
            return redirect()->back()->with('error', 'Slip Gaji untuk bulan dan tahun ini sudah ada!');
        }

        // Ambil karyawan
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        // Ambil data terkait perhitungan gaji berdasarkan bulan & tahun yang dipilih
        $bonusLembur = BonusLembur::where('karyawan_id', $karyawan->id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        $pajakPenghasilan = PajakPenghasilan::where('karyawan_id', $karyawan->id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        // **Perbaikan di sini:** Ambil **potongan berdasarkan bulan & tahun**
        $potongan = Potongan::where('karyawan_id', $karyawan->id)
            ->where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();

        // Gaji Pokok (bisa ditarik dari model Jabatan jika perlu)
        $gajiPokok = $karyawan->jabatan->gaji_pokok ?? 0;

        // Perhitungan Slip Gaji
        $totalBonus = $bonusLembur ? $bonusLembur->bonus : 0;
        $totalLembur = $bonusLembur ? $bonusLembur->lembur : 0;
        $totalPajak = $pajakPenghasilan ? $pajakPenghasilan->jumlah_pajak : 0;
        $totalPotongan = $potongan ? $potongan->jumlah_potongan : 0;

        // Hitung Gaji Bersih
        $jumlahGaji = $gajiPokok + $totalBonus + $totalLembur - $totalPajak - $totalPotongan;

        // Simpan Slip Gaji
        SlipGaji::create([
            'karyawan_id' => $karyawan->id,
            'gaji_pokok' => $gajiPokok,
            'total_bonus' => $totalBonus,
            'total_lembur' => $totalLembur,
            'total_pajak' => $totalPajak,
            'total_potongan' => $totalPotongan,
            'jumlah_gaji' => $jumlahGaji,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
        ]);

        return redirect()->route('slip_gaji.index')->with('success', 'Slip Gaji berhasil dibuat!');
    }


    public function show($id)
    {
        $slipGaji = SlipGaji::with('karyawan')->findOrFail($id);
        return view('slip_gaji.show', compact('slipGaji'));
    }

    public function destroy($id)
    {
        $slipGaji = SlipGaji::findOrFail($id);
        $slipGaji->delete();
        return redirect()->route('slip_gaji.index')->with('success', 'Slip Gaji berhasil dihapus!');
    }




    public function downloadPDF($id)
    {
        $slip = SlipGaji::with('karyawan.jabatan')->findOrFail($id);

        // Debugging: Cek apakah data ditemukan
        if (!$slip) {
            return redirect()->back()->with('error', 'Slip Gaji tidak ditemukan.');
        }

        // Load view untuk PDF dan generate PDF
        $pdf = Pdf::loadView('slip_gaji.pdf_single', compact('slip'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Slip_Gaji_' . $slip->karyawan->nama . '.pdf');
    }


    public function exportAllPDF()
    {
        // Ambil semua data slip gaji
        $slipGaji = SlipGaji::with('karyawan')->get();

        // Jika tidak ada data, kembalikan pesan error
        if ($slipGaji->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data slip gaji untuk didownload.');
        }

        // Generate PDF dari blade view slip_gaji/pdf_all.blade.php
        $pdf = Pdf::loadView('slip_gaji.pdf_all', compact('slipGaji'))
            ->setPaper('a4', 'landscape');

        // Download file langsung
        return $pdf->download('Semua_Slip_Gaji.pdf');
    }
}
