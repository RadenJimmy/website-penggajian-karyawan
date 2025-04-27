@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Pajak Penghasilan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('pajak_penghasilan.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Pajak Penghasilan</a>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Data Pajak Penghasilan</h5>
                <form method="GET" action="{{ route('pajak_penghasilan.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan karyawan, bulan, tahun, atau jumlah pajak" value="{{ request('search') }}">
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
                            <th>Jumlah Pajak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pajakPenghasilan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->karyawan->nama }}</td>
                                <td>{{ $item->bulan }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>Rp {{ number_format($item->jumlah_pajak, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('pajak_penghasilan.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('pajak_penghasilan.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pajak penghasilan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
