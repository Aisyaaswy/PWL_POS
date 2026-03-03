<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'stok_id' => $i,
                'barang_id' => $i,
                'user_id' => 1, 
                'stok_tanggal' => now(),
                'stok_jumlah' => 100,
            ];
        }
        DB::table('t_stok')->insert($data);
    }
}