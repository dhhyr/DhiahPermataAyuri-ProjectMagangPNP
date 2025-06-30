<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'nama_pelanggan',
        'total_barang',
        'total_harga',
        'kasir',
    ];

    protected $dates = ['tanggal'];
}
