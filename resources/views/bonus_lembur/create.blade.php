@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Bonus & Lembur</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Bonus & Lembur</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bonus_lembur.store') }}">
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
                        <label for="bonus">Bonus</label>
                        <input type="number" name="bonus" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="lembur">Lembur</label>
                        <input type="number" name="lembur" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Tambah Bonus & Lembur</button>
                </form>
            </div>
        </div>
    </div>
@endsection
