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
        Schema::create('t_stok', function (Blueprint $table) {
            $table->id('stok_id'); // Primary Key
            $table->unsignedBigInteger('barang_id')->index(); // Foreign Key ke m_barang
            $table->unsignedBigInteger('user_id')->index(); // Foreign Key ke m_user
            $table->dateTime('stok_tanggal'); // Waktu pencatatan stok
            $table->integer('stok_jumlah'); // Jumlah barang (masuk/keluar)
            $table->timestamps();

            // Mendefinisikan relasi Foreign Key
            $table->foreign('barang_id')->references('barang_id')->on('m_barang');
            $table->foreign('user_id')->references('user_id')->on('m_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_stok');
    }
};
