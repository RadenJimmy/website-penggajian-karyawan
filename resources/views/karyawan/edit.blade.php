@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Karyawan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Karyawan: {{ $karyawan->nama }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('karyawan.update', $karyawan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" class="form-control" value="{{ $karyawan->nama }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" class="form-control" required>
                            @foreach($jabatan as $j)
                                <option value="{{ $j->id }}" {{ $karyawan->jabatan_id == $j->id ? 'selected' : '' }}>
                                    {{ $j->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $karyawan->email }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="telepon">Telepon</label>
                        <input type="text" name="telepon" class="form-control" value="{{ $karyawan->telepon }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" class="form-control" required>{{ $karyawan->alamat }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
