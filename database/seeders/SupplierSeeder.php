<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'supplier_kode'   => 'SUP001',
                'supplier_nama'   => 'PT Sumber Makmur',
                'supplier_alamat' => 'Jl. Raya Malang No. 10, Malang',
                'supplier_telp'   => '0341-123456',
            ],
            [
                'supplier_kode'   => 'SUP002',
                'supplier_nama'   => 'CV Maju Bersama',
                'supplier_alamat' => 'Jl. Sudirman No. 5, Malang',
                'supplier_telp'   => '0341-234567',
            ],
            [
                'supplier_kode'   => 'SUP003',
                'supplier_nama'   => 'UD Sejahtera Abadi',
                'supplier_alamat' => 'Jl. Gatot Subroto No. 3, Malang',
                'supplier_telp'   => '0341-345678',
            ],
            [
                'supplier_kode'   => 'SUP004',
                'supplier_nama'   => 'PT Global Niaga',
                'supplier_alamat' => 'Jl. Ahmad Yani No. 20, Malang',
                'supplier_telp'   => '0341-456789',
            ],
            [
                'supplier_kode'   => 'SUP005',
                'supplier_nama'   => 'CV Berkah Jaya',
                'supplier_alamat' => 'Jl. Kertanegara No. 8, Malang',
                'supplier_telp'   => '0341-567890',
            ],
        ];

        DB::table('m_supplier')->insert($data);
    }
}