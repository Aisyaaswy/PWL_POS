<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        $counter = 1;
        for ($i = 1; $i <= 10; $i++) { 
            for ($j = 1; $j <= 3; $j++) { // Input 3 barang per transaksi
                $data[] = [
                    'detail_id' => $counter,
                    'penjualan_id' => $i,
                    'barang_id' => rand(1, 10), // Memilih random dari 10 barang yang ada
                    'harga' => 15000,
                    'jumlah' => rand(1, 5),
                ];
                $counter++;
            }
        }
        DB::table('t_penjualan_detail')->insert($data);
    }
}