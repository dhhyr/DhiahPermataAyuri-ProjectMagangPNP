<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Laporan; // <-- WAJIB ditambahkan

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Laporan::insert([
            [
                'tanggal' => now()->subDays(1),
                'nama_pelanggan' => 'Andi Setiawan',
                'total_barang' => 4,
                'total_harga' => 120000,
                'kasir' => 'admin1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal' => now(),
                'nama_pelanggan' => 'Dina Mulyani',
                'total_barang' => 6,
                'total_harga' => 245000,
                'kasir' => 'admin2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
