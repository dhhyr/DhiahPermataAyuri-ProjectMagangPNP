@extends('layout.main')

@section('content')
<div class="container">
    <h2>Edit Penjualan</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Faktur</label>
            <input type="text" name="faktur" class="form-control" value="{{ $penjualan->faktur }}" readonly>
        </div>

        <div class="form-group">
            <label>Barang</label>
            <select name="barang" class="form-control" required>
                @foreach($barang as $b)
                    <option value="{{ $b->nama_barang }}"
                        {{ $penjualan->barang == $b->nama_barang ? 'selected' : '' }}>
                        {{ $b->nama_barang }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Harga Barang</label>
            <input type="number" id="harga_barang" name="harga_barang" class="form-control" value="{{ $penjualan->harga_barang }}" required>
        </div>

        <div class="form-group">
            <label>Jumlah Quantity</label>
            <input type="number" id="jumlah_quantity" name="jumlah_quantity" class="form-control" value="{{ $penjualan->jumlah_quantity }}" required>
        </div>

        <div class="form-group">
            <label>Harga Total</label>
            <input type="number" id="harga_total" name="harga_total" class="form-control" value="{{ $penjualan->harga_total }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

{{-- SCRIPT UNTUK MENGHITUNG TOTAL OTOMATIS --}}
<script>
    const hargaInput = document.getElementById('harga_barang');
    const qtyInput = document.getElementById('jumlah_quantity');
    const totalInput = document.getElementById('harga_total');

    function updateTotal() {
        const harga = parseFloat(hargaInput.value) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        totalInput.value = harga * qty;
    }

    hargaInput.addEventListener('input', updateTotal);
    qtyInput.addEventListener('input', updateTotal);
</script>
@endsection
