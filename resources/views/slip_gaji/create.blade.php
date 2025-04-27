@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Slip Gaji</h1>

        <!-- ✅ ALERT ERROR -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5>Form Slip Gaji</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('slip_gaji.store') }}">
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

                    <button type="submit" class="btn btn-primary mt-4">Generate Slip Gaji</button>
                </form>
            </div>
        </div>
        <a href="{{ route('slip_gaji.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection

