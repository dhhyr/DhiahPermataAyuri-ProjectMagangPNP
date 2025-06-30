@extends('layout.main')

@section('content')
<div class="container">
    <h1 class="mt-4 mb-4">Laporan Penjualan</h1>

   <a href="{{ route('laporan.export') }}" class="btn btn-danger mb-3" target="_blank">
    <i class="fas fa-file-pdf"></i> Export PDF
</a>


    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Faktur</th>
                <th>Barang</th>
                <th>Harga Barang</th>
                <th>Qty</th>
                <th>Harga Total</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->faktur }}</td>
                <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                <td>Rp {{ number_format($p->harga_barang, 0, ',', '.') }}</td>
                <td>{{ $p->jumlah_quantity }}</td>
                <td>Rp {{ number_format($p->harga_total, 0, ',', '.') }}</td>
                <td>{{ $p->created_at->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
