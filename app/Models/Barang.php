<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kategori',
        'stok',
        'harga_beli',
        'harga_jual'
    ];
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'barang_id');
    }
}
