<?php

use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenggunaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('produk', ProdukController::class);
Route::resource('pengguna', PenggunaController::class);
Route::resource('pemesanan', PemesananController::class);
Route::resource('pembayaran', PembayaranController::class);