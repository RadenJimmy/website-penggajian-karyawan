@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Bonus & Lembur</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Bonus & Lembur: {{ $bonusLembur->karyawan->nama }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('bonus_lembur.update', $bonusLembur->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="karyawan_id">Karyawan</label>
                        <select name="karyawan_id" class="form-control" required>
                            @foreach($karyawan as $k)
                                <option value="{{ $k->id }}" {{ $bonusLembur->karyawan_id == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="bulan">Bulan</label>
                        <select name="bulan" class="form-control" required>
                            @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                <option value="{{ $bulan }}" {{ $bonusLembur->bulan == $bulan ? 'selected' : '' }}>
                                    {{ $bulan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="tahun">Tahun</label>
                        <input type="number" name="tahun" class="form-control" required value="{{ $bonusLembur->tahun }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="bonus">Bonus</label>
                        <input type="number" name="bonus" class="form-control" required value="{{ $bonusLembur->bonus }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="lembur">Lembur</label>
                        <input type="number" name="lembur" class="form-control" required value="{{ $bonusLembur->lembur }}">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
