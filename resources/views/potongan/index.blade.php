@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Data Potongan Gaji</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    <a href="{{ route('potongan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Potongan
    </a>
    
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Potongan Gaji</h5>
            <form method="GET" action="{{ route('potongan.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan karyawan, bulan, tahun, jumlah potongan, atau keterangan" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Karyawan</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Jumlah Potongan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($potongan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->karyawan->nama }}</td>
                        <td>{{ $item->bulan }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>Rp {{ number_format($item->jumlah_potongan, 0, ',', '.') }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>
                            <a href="{{ route('potongan.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                            <form method="POST" action="{{ route('potongan.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus potongan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data potongan gaji</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
