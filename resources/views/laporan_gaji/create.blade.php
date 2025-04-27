@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Buat Laporan Penggajian Baru</h2>

    <form action="{{ route('laporan-gaji.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Periode (Bulan & Tahun)</label>
            <input type="month" name="periode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Buat Laporan</button>
    </form>
</div>
@endsection
