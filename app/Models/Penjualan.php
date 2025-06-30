<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
     protected $table = 'penjualan';

    protected $fillable = [
        'faktur',
         'barang_id',
        'harga_barang',
        'jumlah_quantity',
        'harga_total',
    
    ];
     public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}
