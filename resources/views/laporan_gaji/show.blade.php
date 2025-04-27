@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Penggajian - {{ \Carbon\Carbon::parse($laporan->periode)->translatedFormat('F Y') }}</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Karyawan</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Tunjangan</th>
                <th>Pajak</th>
                <th>Potongan BPJS</th>
                <th>Gaji Bersih</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slipGaji as $index => $sg)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $sg->karyawan->nama }}</td>
                <td>{{ $sg->karyawan->jabatan->nama }}</td>
                <td>Rp {{ number_format($sg->karyawan->jabatan->gaji_pokok, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sg->karyawan->jabatan->tunjangan, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sg->pajak, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($sg->potongan_bpjs, 0, ',', '.') }}</td>
                <td><strong>Rp {{ number_format($sg->gaji_bersih, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
