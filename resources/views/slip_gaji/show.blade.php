@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Slip Gaji {{ $slipGaji->karyawan->nama }} - {{ $slipGaji->bulan }} {{ $slipGaji->tahun }}</h1>

        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Karyawan</th>
                        <td>{{ $slipGaji->karyawan->nama }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $slipGaji->karyawan->jabatan->nama_jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Bulan</th>
                        <td>{{ $slipGaji->bulan }}</td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <td>{{ $slipGaji->tahun }}</td>
                    </tr>
                    <tr>
                        <th>Gaji Pokok</th>
                        <td>Rp {{ number_format($slipGaji->gaji_pokok, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Bonus</th>
                        <td>Rp {{ number_format($slipGaji->total_bonus, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Lembur</th>
                        <td>Rp {{ number_format($slipGaji->total_lembur, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Pajak</th>
                        <td>Rp {{ number_format($slipGaji->total_pajak, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Potongan</th>
                        <td>Rp {{ number_format($slipGaji->total_potongan, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Total Gaji</th>
                        <td>Rp {{ number_format($slipGaji->jumlah_gaji, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <a href="{{ route('slip_gaji.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
