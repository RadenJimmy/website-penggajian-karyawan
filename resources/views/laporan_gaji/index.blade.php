@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Penggajian</h2>
    <a href="{{ route('laporan-gaji.create') }}" class="btn btn-primary">Buat Laporan Baru</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Periode</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $index => $lp)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($lp->periode)->translatedFormat('F Y') }}</td>
                <td>
                    <a href="{{ route('laporan-gaji.show', $lp->id) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
