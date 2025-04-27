@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Pajak Penghasilan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Pajak Penghasilan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('pajak_penghasilan.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="karyawan_id">Karyawan</label>
                        <select name="karyawan_id" class="form-control" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }} - {{ $k->nik }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control" required>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}">{{ $bulan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required value="{{ date('Y') }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah_pajak">Jumlah Pajak</label>
                        <input type="number" name="jumlah_pajak" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Tambah Pajak</button>
                </form>
            </div>
        </div>
    </div>
@endsection
