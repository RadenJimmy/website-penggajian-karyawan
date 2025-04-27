@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Potongan Gaji</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Potongan: {{ $potongan->karyawan->nama }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('potongan.update', $potongan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="karyawan_id">Karyawan</label>
                        <select name="karyawan_id" class="form-control" required disabled>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}" {{ $potongan->karyawan_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control" required>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}" {{ $potongan->bulan == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ $potongan->tahun }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jumlah_potongan">Jumlah Potongan</label>
                        <input type="number" name="jumlah_potongan" class="form-control" value="{{ $potongan->jumlah_potongan }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" required>{{ $potongan->keterangan }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
