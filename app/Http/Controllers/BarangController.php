<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function formTambah()
    {
        $kategori = ['Beras', 'Padi', 'Dedak', 'Sekam'];
        return view('barang.tambah', compact('kategori'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required|in:Beras,Padi,Dedak,Sekam',
            'stok' => 'required|integer',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
        ]);

        Barang::create($request->all());
        return redirect('/barang')->with('success', 'Barang ditambahkan');
    }

    public function formEdit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = ['Beras', 'Padi', 'Dedak', 'Sekam'];
        return view('barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return redirect('/barang')->with('success', 'Barang diupdate');
    }

    public function hapus($id)
    {
        Barang::destroy($id);
        return redirect('/barang')->with('success', 'Barang dihapus');
    }
}
