<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
       public function index()
    {
        $penjualan = Penjualan::with('barang')->latest()->get();
        return view('laporan.index', compact('penjualan'));
    }

    public function exportPdf()
    {
        $penjualan = Penjualan::with('barang')->latest()->get();
        $pdf = Pdf::loadView('laporan.pdf', compact('penjualan'));
        return $pdf->download('laporan-penjualan.pdf');
    }
}
