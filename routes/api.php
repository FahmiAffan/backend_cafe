<?php

use App\Http\Controllers\Api\GetUser;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\MejaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

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

Route::resource('produk', MenuController::class);
Route::resource('pengguna', PenggunaController::class);
Route::resource('pemesanan', PemesananController::class);
Route::resource('meja', MejaController::class);
Route::get('/getimg', [MenuController::class, 'getImage']);
Route::put('/updateqty/{$id}', [PemesananController::class, 'UpdateQty']);


// Route::group(['middleware' => ['auth' , 'hakakses:admin,manajer,kasir']], function(){
//     Route::resource('produk', MenuController::class);
//     Route::resource('pengguna', PenggunaController::class);
//     Route::resource('pemesanan', PemesananController::class);
//     Route::resource('meja', MejaController::class);
//     Route::get('/getimg/{id}', [MenuController::class, 'getImage']);
// });

Route::get('/getUser', [GetUser::class, 'getUser']);
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');
Route::middleware('auth:api')->resource('/user',UserController::class);
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');