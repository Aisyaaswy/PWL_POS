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
        Schema::create('t_penjualan', function (Blueprint $table) {
            $table->id('penjualan_id');
            $table->unsignedBigInteger('user_id')->index(); // Foreign Key ke user_id pada tabel m_user
            $table->string('pembeli', 50); 
            $table->string('penjualan_kode', 20)->unique(); 
            $table->dateTime('penjualan_tanggal');
            $table->timestamps();

            // mendefinisikan foreign key pada kolom user_id yang merujuk ke kolom user_id pada tabel m_user
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_penjualan');
    }
};
