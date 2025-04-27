@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Pembayaran Gaji</h1>

    <a href="{{ route('pembayaran_gaji.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Informasi Pembayaran</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Karyawan</th>
                    <td>{{ $pembayaran->karyawan->nama }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ $pembayaran->tanggal_pembayaran }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $pembayaran->metode_pembayaran }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $pembayaran->status == 'selesai' ? 'success' : 'warning' }}">
                            {{ ucfirst($pembayaran->status) }}
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Detail Slip Gaji</h5>
        </div>
        <div class="card-body">
            @if ($pembayaran->slipGaji)
            <table class="table">
                <tr>
                    <th>Periode</th>
                    <td>{{ $pembayaran->slipGaji->periode }}</td>
                </tr>
                <tr>
                    <th>Gaji Pokok</th>
                    <td>Rp {{ number_format($pembayaran->slipGaji->gaji_pokok, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Bonus</th>
                    <td>Rp {{ number_format($pembayaran->slipGaji->total_bonus, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Lembur</th>
                    <td>Rp {{ number_format($pembayaran->slipGaji->total_lembur, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Pajak</th>
                    <td>Rp {{ number_format($pembayaran->slipGaji->total_pajak, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Potongan</th>
                    <td>Rp {{ number_format($pembayaran->slipGaji->total_potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Total Gaji</th>
                    <td>
                        <strong>Rp {{ number_format($pembayaran->slipGaji->jumlah_gaji, 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </table>
            @else
            <div class="alert alert-danger">Slip Gaji tidak ditemukan.</div>
            @endif
        </div>
    </div>
</div>
@endsection