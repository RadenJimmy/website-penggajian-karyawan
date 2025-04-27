@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Karyawan</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="d-flex mb-3">
        <a href="{{ route('karyawan.create') }}" class="btn btn-primary me-2">
            <i class="fas fa-plus"></i> Tambah Karyawan
        </a>
        <button class="btn btn-success" onclick="document.getElementById('importFile').click()">
        <i class="fas fa-file"></i>
            Import Excel
        </button>
        <form id="importForm" action="{{ route('karyawan.import') }}" method="POST" enctype="multipart/form-data" style="display: none;">
            @csrf
            <input type="file" id="importFile" name="file" onchange="document.getElementById('importForm').submit()" hidden>
        </form>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Data Karyawan</h5>
            <form method="GET" action="{{ route('karyawan.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama, jabatan, email, atau telepon" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Cari</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawan as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jabatan->nama_jabatan }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->telepon }}</td>
                        <td>
                            <a href="{{ route('karyawan.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                            <form method="POST" action="{{ route('karyawan.destroy', $item->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus karyawan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data karyawan ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection