@extends('layout.main') {{-- Abaikan jika belum pakai layout --}}

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Penjualan</h1>

    {{-- Tombol Tambah --}}
    <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Penjualan
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header font-weight-bold text-primary">
            Daftar Penjualan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Faktur</th>
                            <th>Barang</th>
                            <th>Harga Barang</th>
                            <th>Quantity</th>
                            <th>Harga Total</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penjualan as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->faktur }}</td>
                                <td>{{ $p->barang->nama_barang ?? '-' }}</td>
                                <td>Rp {{ number_format($p->harga_barang, 0, ',', '.') }}</td>
                                <td>{{ $p->jumlah_quantity }}</td>
                                <td>Rp {{ number_format($p->harga_total, 0, ',', '.') }}</td>
                                <td>{{ $p->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <a href="{{ route('penjualan.edit', $p->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('penjualan.hapus', $p->id) }}"
                                       onclick="return confirm('Yakin ingin menghapus data ini?')"
                                       class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
