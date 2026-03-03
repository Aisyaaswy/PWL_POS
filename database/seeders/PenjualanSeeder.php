<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'penjualan_id' => $i,
                'user_id' => 3, 
                'pembeli' => 'Pelanggan ' . $i,
                'penjualan_kode' => 'INV' . sprintf("%03d", $i),
                'penjualan_tanggal' => now(),
            ];
        }
        DB::table('t_penjualan')->insert($data);
    }
}