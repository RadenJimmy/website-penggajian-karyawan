<?php
namespace App\Exports;

use App\Models\PembayaranGaji;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PembayaranGajiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return PembayaranGaji::with(['karyawan', 'slipGaji.karyawan.jabatan'])->get();
    }

    public function headings(): array
    {
        return [
            'Tahun',
            'Bulan',
            'NIK',
            'Nama Karyawan',
            'Jabatan',
            'Jumlah Gaji',
            'Status',
            'Jumlah Pending',
            'Jumlah Selesai'
        ];
    }

    public function map($pembayaran): array
    {
        return [
            date('Y', strtotime($pembayaran->tanggal_pembayaran)),
            date('F', strtotime($pembayaran->tanggal_pembayaran)),
            $pembayaran->karyawan->nik,
            $pembayaran->karyawan->nama,
            $pembayaran->karyawan->jabatan->nama_jabatan ?? '-',
            number_format($pembayaran->slipGaji->jumlah_gaji, 0, ',', '.'),
            ucfirst($pembayaran->status),
            PembayaranGaji::where('status', 'pending')->count(),
            PembayaranGaji::where('status', 'selesai')->count()
        ];
    }
}
