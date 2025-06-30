<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // Ambil data penjualan hari ini beserta relasi barang
        $penjualanHariIni = Penjualan::with('barang')->whereDate('created_at', $today)->get();

        // Area Chart: Total penjualan hari ini per barang
        $labels = $penjualanHariIni->map(fn($item) => $item->barang->nama_barang);
        $data = $penjualanHariIni->map(fn($item) => $item->harga_total);

        // Pie Chart: Jumlah barang terjual hari ini per kategori
        $kategoriData = [];
        foreach ($penjualanHariIni as $penjualan) {
            $kategori = $penjualan->barang->kategori ?? 'Lainnya';

            if (!isset($kategoriData[$kategori])) {
                $kategoriData[$kategori] = 0;
            }

            $kategoriData[$kategori] += $penjualan->jumlah_quantity;
        }

        $pieLabels = array_keys($kategoriData);
        $pieData = array_values($kategoriData);

        return view('dashboard', compact('labels', 'data', 'pieLabels', 'pieData'));
    }
}