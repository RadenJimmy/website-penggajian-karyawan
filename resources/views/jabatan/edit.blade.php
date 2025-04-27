@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Edit Jabatan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Edit Jabatan: {{ $jabatan->nama_jabatan }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jabatan.update', $jabatan->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" value="{{ $jabatan->nama_jabatan }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" value="{{ $jabatan->gaji_pokok }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
