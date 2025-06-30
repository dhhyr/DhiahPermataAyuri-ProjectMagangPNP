<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Support\Facades\Session;

class PenjualanController extends Controller
{
     public function index(){
       $penjualan = Penjualan::with('barang')
    ->orderBy('created_at', 'desc')
    ->get();

        return view('penjualan.index', compact('penjualan'));
     }

     public function create()
    {
        $barang = Barang::all();
        $keranjang = session()->get('keranjang', []);

        return view('penjualan.create', compact('barang', 'keranjang'));
    }

    public function tambahKeKeranjang(Request $request)
    {
        $barang = Barang::findOrFail($request->barang_id);

        $keranjang = session()->get('keranjang', []);

        $id = $barang->id;
        $qty = $request->jumlah;

        if (isset($keranjang[$id])) {
            $keranjang[$id]['qty'] += $qty;
        } else {
            $keranjang[$id] = [
                'nama' => $barang->nama_barang,
                'harga' => $barang->harga_jual,
                'qty' => $qty,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect()->route('penjualan.create')->with('success', 'Barang ditambahkan ke keranjang.');
    }
   public function simpan(Request $request)
{
    $keranjang = Session::get('keranjang', []);

    if (empty($keranjang)) {
        return redirect()->back()->with('error', 'Keranjang masih kosong!');
    }

    foreach ($keranjang as $barangId => $item) {
        $barang = Barang::findOrFail($barangId);

        // Validasi stok cukup
        if ($barang->stok < $item['qty']) {
            return redirect()->back()->with('error', 'Stok barang "' . $barang->nama_barang . '" tidak mencukupi.');
        }

        // Simpan transaksi penjualan
        Penjualan::create([
            'faktur'           => 'FAK-' . date('dmY') . '-' . rand(100, 999),
           'barang_id'        => $barangId,
            'harga_barang'     => $item['harga'],
            'jumlah_quantity'  => $item['qty'],
            'harga_total'      => $item['harga'] * $item['qty'],
        ]);

        // Kurangi stok barang
        $barang->stok -= $item['qty'];
        $barang->save();
    }

    // Hapus keranjang
    Session::forget('keranjang');

    return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil disimpan dan stok telah dikurangi.');
}

public function formEdit($id)
{
    $penjualan = Penjualan::findOrFail($id);
    $barang = Barang::all();

    return view('penjualan.edit', compact('penjualan', 'barang'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'faktur' => 'required',
        'barang' => 'required',
        'harga_barang' => 'required|numeric',
        'jumlah_quantity' => 'required|integer|min:1',
        'harga_total' => 'required|numeric',
    ]);

    $penjualan = Penjualan::findOrFail($id);
    $penjualan->update($request->all());

    return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil diperbarui.');
}

public function hapus($id)
{
    $penjualan = Penjualan::find($id);

    if (!$penjualan) {
        return redirect()->route('penjualan.index')->with('error', 'Data tidak ditemukan.');
    }

    $penjualan->delete();

    return redirect()->route('penjualan.index')->with('success', 'Data penjualan berhasil dihapus.');
}

}