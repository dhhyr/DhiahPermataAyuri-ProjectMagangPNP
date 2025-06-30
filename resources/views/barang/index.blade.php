@extends('layout.main')

@section('content')
<div class="container-fluid">
    <!-- Notifikasi sukses -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Data Barang -->
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h6 class="m-0">Data Barang</h6>
            <a href="{{ route('barang.tambah') }}" class="btn btn-light btn-sm">
                <i class="fas fa-plus"></i> Tambah Barang
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle text-center">
                    <thead class="bg-light">
                        <tr class="text-nowrap">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $b)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $b->nama_barang }}</td>
                            <td>{{ $b->kategori }}</td>
                            <td>{{ $b->stok }}</td>
                            <td>Rp{{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                            <td>Rp{{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('barang.hapus', $b->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada data barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
