<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('faktur')->unique();           // Nomor faktur, wajib unik
            $table->string('barang');                     // Nama barang
            $table->integer('harga_barang');              // Harga satuan
            $table->integer('jumlah_quantity');           // Jumlah yang dibeli
            $table->integer('harga_total');               // Total harga = harga_barang × jumlah_quantity
            $table->timestamps();   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
