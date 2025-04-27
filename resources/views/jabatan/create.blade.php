@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Tambah Jabatan</h1>

        <div class="card">
            <div class="card-header">
                <h5>Form Jabatan</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('jabatan.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="number" name="gaji_pokok" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Tambah Jabatan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
