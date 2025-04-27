@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pembayaran Gaji</h1>

    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Form Pembayaran Gaji</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('pembayaran_gaji.store') }}" method="POST">
                @csrf

                <!-- Pilih Karyawan -->
                <div class="mb-3">
                    <label for="karyawan_id" class="form-label"><strong>Karyawan</strong></label>
                    <select name="karyawan_id" id="karyawan_id" class="form-control" required>
                        <option value="">Pilih Karyawan</option>
                        @foreach($karyawan as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }} - {{ $k->nik }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Pilih Slip Gaji -->
                <div class="mb-3">
                    <label for="slip_gaji_id" class="form-label"><strong>Slip Gaji</strong></label>
                    <select name="slip_gaji_id" id="slip_gaji_id" class="form-control" required>
                        <option value="">Pilih Slip Gaji</option>
                    </select>
                </div>

                <!-- Tanggal Pembayaran -->
                <div class="mb-3">
                    <label for="tanggal_pembayaran" class="form-label"><strong>Tanggal Pembayaran</strong></label>
                    <input type="date" name="tanggal_pembayaran" id="tanggal_pembayaran" class="form-control" required>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label"><strong>Metode Pembayaran</strong></label>
                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-control" required>
                        <option value="Transfer Bank">Transfer Bank</option>
                        <option value="Tunai">Tunai</option>
                        <option value="E-Wallet">E-Wallet</option>
                    </select>
                </div>

                <!-- Status Pembayaran -->
                <div class="mb-3">
                    <label for="status" class="form-label"><strong>Status Pembayaran</strong></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="pending">Pending</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <!-- Tombol Simpan & Kembali -->
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-save"></i> Simpan Pembayaran
                    </button>
                    <a href="{{ route('pembayaran_gaji.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#karyawan_id').change(function() {
            let karyawanId = $(this).val();
            let slipGajiDropdown = $('#slip_gaji_id');
            slipGajiDropdown.empty().append('<option value="">Pilih Slip Gaji</option>');

            if (karyawanId) {
                $.ajax({
                    url: `/get-slip-gaji/${karyawanId}`, // Gunakan route yang memanggil method getSlipGajiByKaryawan()
                    type: 'GET',
                    success: function(data) {
                        if (data.length > 0) {
                            $.each(data, function(index, slip) {
                                slipGajiDropdown.append(
                                    `<option value="${slip.id}">Bulan: ${slip.bulan}, Tahun: ${slip.tahun} - Rp ${parseInt(slip.jumlah_gaji).toLocaleString('id-ID')}</option>`
                                );
                            });
                        } else {
                            slipGajiDropdown.append('<option value="">Tidak ada slip gaji yang belum dibayar</option>');
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data slip gaji.');
                    }
                });
            }
        });
    });
</script>