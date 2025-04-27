@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Hai Bolo</h1>

    <!-- Statistik Cards -->
    <div class="row">
        <!-- Total Karyawan -->
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <h5>Total Karyawan</h5>
                    <h2>{{ $totalKaryawan }}</h2>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="/karyawan" class="text-white">Lihat Detail</a>
                    <i class="fas fa-users fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Total Slip Gaji -->
        <div class="col-md-3">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <h5>Slip Gaji Dibayar</h5>
                    <h2>{{ $totalSlipGajiDibayar }}</h2>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="/slip_gaji" class="text-white">Lihat Detail</a>
                    <i class="fas fa-file-invoice-dollar fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Total Gaji Dibayar -->
        <div class="col-md-3">
            <div class="card bg-warning text-white shadow">
                <div class="card-body">
                    <h5>Total Gaji Dibayar</h5>
                    <h2>Rp {{ number_format($totalGajiDibayar, 0, ',', '.') }}</h2>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a href="/pembayaran_gaji" class="text-white">Lihat Detail</a>
                    <i class="fas fa-money-bill-wave fa-2x"></i>
                </div>
            </div>
        </div>

        <!-- Total Transaksi -->
        <div class="col-md-3">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <h5>Total Transaksi</h5>
                    <h2>{{ $totalTransaksi }}</h2>
                </div>
                <div class="card-footer d-flex justify-content-end align-items-center">
                    <i class="fas fa-exchange-alt fa-2x"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Pengeluaran Gaji -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Grafik Pengeluaran Gaji</h5>
        </div>
        <div class="card-body">
            <canvas id="gajiChart"></canvas>
        </div>
    </div>
</div>

<!-- Load Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('gajiChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($bulan),
                datasets: [{
                    label: 'Total Gaji Dibayar',
                    data: @json($pengeluaranGaji),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection