@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detail Karyawan</h2>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nama:</strong> {{ $karyawan->nama }}</li>
        <li class="list-group-item"><strong>Email:</strong> {{ $karyawan->email }}</li>
        <li class="list-group-item"><strong>No HP:</strong> {{ $karyawan->no_hp }}</li>
        <li class="list-group-item"><strong>Jabatan:</strong> {{ $karyawan->jabatan->nama }}</li>
    </ul>
    <a href="{{ route('karyawan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
