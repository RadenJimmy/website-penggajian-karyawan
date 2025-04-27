@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Daftar Jabatan</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('jabatan.create') }}" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Jabatan</a>
        
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Jabatan yang Tersedia</h5>
                <form method="GET" action="{{ route('jabatan.index') }}" class="mb-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Nama Jabatan" value="{{ request('search') }}">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jabatan</th>
                            <th>Gaji Pokok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jabatan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_jabatan }}</td>
                                <td>Rp {{ number_format($item->gaji_pokok, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-warning btn-sm">Ubah</a>
                                    
                                    <!-- Delete Form -->
                                    <form method="POST" action="{{ route('jabatan.destroy', $item->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
