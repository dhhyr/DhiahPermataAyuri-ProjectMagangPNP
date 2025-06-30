<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Faktur</th>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->faktur }}</td>
                <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                <td>{{ number_format($p->harga_barang, 0, ',', '.') }}</td>
                <td>{{ $p->jumlah_quantity }}</td>
                <td>{{ number_format($p->harga_total, 0, ',', '.') }}</td>
                <td>{{ $p->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
