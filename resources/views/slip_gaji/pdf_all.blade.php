<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Slip Gaji - Semua Data</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>

    <h2>Slip Gaji - Semua Data</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Karyawan</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Gaji Pokok</th>
                <th>Bonus</th>
                <th>Lembur</th>
                <th>Pajak</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slipGaji as $index => $slip)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $slip->karyawan->nama }}</td>
                    <td>{{ $slip->bulan }}</td>
                    <td>{{ $slip->tahun }}</td>
                    <td>Rp {{ number_format($slip->gaji_pokok, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($slip->total_bonus, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($slip->total_lembur, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($slip->total_pajak, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($slip->total_potongan, 0, ',', '.') }}</td>
                    <td><strong>Rp {{ number_format($slip->jumlah_gaji, 0, ',', '.') }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
