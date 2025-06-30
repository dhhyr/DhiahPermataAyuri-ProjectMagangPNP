@extends('layout.main')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Penjualan</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- FORM TAMBAH BARANG --}}
    <form action="{{ route('penjualan.tambahKeranjang') }}" method="POST" class="mb-4">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="barang_id">Pilih Barang</label>
                <select name="barang_id" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($barang as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} - Rp {{ number_format($b->harga_jual, 0, ',', '.') }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="jumlah">Jumlah</label>
                <input type="number" name="jumlah" value="1" min="1" class="form-control" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-success w-100">+ Tambah ke Keranjang</button>
            </div>
        </div>
    </form>

    {{-- FORM SIMPAN PENJUALAN --}}
    <form action="{{ route('penjualan.simpan') }}" method="POST">
        @csrf
        <div class="row mb-4">
            <div class="col-md-6">
                <label>Nomor Faktur</label>
                <input type="text" name="faktur" class="form-control" value="FAK-{{ date('dmY') }}-{{ rand(100,999) }}" readonly>
            </div>
            <div class="col-md-6">
                <label>Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}">
            </div>
        </div>

        <div class="card border-left-primary">
            <div class="card-header font-weight-bold">Daftar Pembelian</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; $i = 1; @endphp
                        @forelse($keranjang as $id => $item)
                            @php
                                $subtotal = $item['harga'] * $item['qty'];
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                                <td>{{ $item['qty'] }}</td>
                                <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada barang yang dipilih</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="text-right">
                    <h5>Total: Rp {{ number_format($total, 0, ',', '.') }}</h5>
                    <button type="submit" class="btn btn-primary mt-3">Proses Penjualan</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
