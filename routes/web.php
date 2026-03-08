<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\PenjualanController;

// Halaman utama / dashboard
Route::get('/', [WelcomeController::class, 'index']);

// ---------------------------------------------------------------
// Route CRUD User (referensi - sudah ada sebelumnya)
// ---------------------------------------------------------------
Route::group(['prefix' => 'user'], function () {
    Route::get('/',           [UserController::class, 'index']);   // menampilkan halaman awal user
    Route::post('/list',      [UserController::class, 'list']);    // data user JSON untuk datatables
    Route::get('/create',     [UserController::class, 'create']);  // form tambah user
    Route::post('/',          [UserController::class, 'store']);   // simpan user baru
    Route::get('/{id}',       [UserController::class, 'show']);    // detail user
    Route::get('/{id}/edit',  [UserController::class, 'edit']);    // form edit user
    Route::put('/{id}',       [UserController::class, 'update']); // simpan perubahan user
    Route::delete('/{id}',    [UserController::class, 'destroy']);// hapus user
});

// ---------------------------------------------------------------
// Route CRUD Level
// ---------------------------------------------------------------
Route::group(['prefix' => 'level'], function () {
    Route::get('/',           [LevelController::class, 'index']);
    Route::post('/list',      [LevelController::class, 'list']);
    Route::get('/create',     [LevelController::class, 'create']);
    Route::post('/',          [LevelController::class, 'store']);
    Route::get('/{id}',       [LevelController::class, 'show']);
    Route::get('/{id}/edit',  [LevelController::class, 'edit']);
    Route::put('/{id}',       [LevelController::class, 'update']);
    Route::delete('/{id}',    [LevelController::class, 'destroy']);
});

// ---------------------------------------------------------------
// Route CRUD Kategori
// ---------------------------------------------------------------
Route::group(['prefix' => 'kategori'], function () {
    Route::get('/',           [KategoriController::class, 'index']);
    Route::post('/list',      [KategoriController::class, 'list']);
    Route::get('/create',     [KategoriController::class, 'create']);
    Route::post('/',          [KategoriController::class, 'store']);
    Route::get('/{id}',       [KategoriController::class, 'show']);
    Route::get('/{id}/edit',  [KategoriController::class, 'edit']);
    Route::put('/{id}',       [KategoriController::class, 'update']);
    Route::delete('/{id}',    [KategoriController::class, 'destroy']);
});

// ---------------------------------------------------------------
// Route CRUD Supplier
// ---------------------------------------------------------------
Route::group(['prefix' => 'supplier'], function () {
    Route::get('/',           [SupplierController::class, 'index']);
    Route::post('/list',      [SupplierController::class, 'list']);
    Route::get('/create',     [SupplierController::class, 'create']);
    Route::post('/',          [SupplierController::class, 'store']);
    Route::get('/{id}',       [SupplierController::class, 'show']);
    Route::get('/{id}/edit',  [SupplierController::class, 'edit']);
    Route::put('/{id}',       [SupplierController::class, 'update']);
    Route::delete('/{id}',    [SupplierController::class, 'destroy']);
});

// ---------------------------------------------------------------
// Route CRUD Barang
// ---------------------------------------------------------------
Route::group(['prefix' => 'barang'], function () {
    Route::get('/',           [BarangController::class, 'index']);
    Route::post('/list',      [BarangController::class, 'list']);
    Route::get('/create',     [BarangController::class, 'create']);
    Route::post('/',          [BarangController::class, 'store']);
    Route::get('/{id}',       [BarangController::class, 'show']);
    Route::get('/{id}/edit',  [BarangController::class, 'edit']);
    Route::put('/{id}',       [BarangController::class, 'update']);
    Route::delete('/{id}',    [BarangController::class, 'destroy']);
});

// ---------------------------------------------------------------
// Route CRUD Stok Barang
// ---------------------------------------------------------------
Route::group(['prefix' => 'stok'], function () {
    Route::get('/',           [StokController::class, 'index']);
    Route::post('/list',      [StokController::class, 'list']);
    Route::get('/create',     [StokController::class, 'create']);
    Route::post('/',          [StokController::class, 'store']);
    Route::get('/{id}',       [StokController::class, 'show']);
    Route::get('/{id}/edit',  [StokController::class, 'edit']);
    Route::put('/{id}',       [StokController::class, 'update']);
    Route::delete('/{id}',    [StokController::class, 'destroy']);
});

// ---------------------------------------------------------------
// Route CRUD Transaksi Penjualan
// ---------------------------------------------------------------
Route::group(['prefix' => 'penjualan'], function () {
    Route::get('/',           [PenjualanController::class, 'index']);
    Route::post('/list',      [PenjualanController::class, 'list']);
    Route::get('/create',     [PenjualanController::class, 'create']);
    Route::post('/',          [PenjualanController::class, 'store']);
    Route::get('/{id}',       [PenjualanController::class, 'show']);
    Route::get('/{id}/edit',  [PenjualanController::class, 'edit']);
    Route::put('/{id}',       [PenjualanController::class, 'update']);
    Route::delete('/{id}',    [PenjualanController::class, 'destroy']);
});