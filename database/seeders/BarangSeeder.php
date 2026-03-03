<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'BRG01', 'barang_nama' => 'Nasi Goreng', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'BRG02', 'barang_nama' => 'Mie Ayam', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'BRG03', 'barang_nama' => 'Es Teh', 'harga_beli' => 2000, 'harga_jual' => 5000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'BRG04', 'barang_nama' => 'Kopi Hitam', 'harga_beli' => 3000, 'harga_jual' => 7000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'BRG05', 'barang_nama' => 'Keripik Singkong', 'harga_beli' => 5000, 'harga_jual' => 8000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'BRG06', 'barang_nama' => 'Kacang Atom', 'harga_beli' => 4000, 'harga_jual' => 6000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'BRG07', 'barang_nama' => 'Bedak Tabur', 'harga_beli' => 20000, 'harga_jual' => 25000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'BRG08', 'barang_nama' => 'Lipstik Merah', 'harga_beli' => 30000, 'harga_jual' => 45000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'BRG09', 'barang_nama' => 'Vitamin C', 'harga_beli' => 15000, 'harga_jual' => 20000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'BRG10', 'barang_nama' => 'Masker Medis', 'harga_beli' => 40000, 'harga_jual' => 55000],
        ];
        DB::table('m_barang')->insert($data);
    }
}