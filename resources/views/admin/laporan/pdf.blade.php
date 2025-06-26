<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; margin-bottom: 20px;}
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
    </style>
</head>
<body>
    <h1>Laporan Pendapatan</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Tiket</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pelanggan</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($laporan as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nomor_tiket }}</td>
                <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                <td>{{ $item->user->name }}</td>
                <td style="text-align: right;">Rp {{ number_format($item->total_pembayaran, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="total">Total Pendapatan:</td>
                <td class="total" style="text-align: right;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
