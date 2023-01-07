<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// ENDPOINT KOTA
Route::get('/list-kota', [App\Http\Controllers\Api\ApiKotaController::class, 'listKota']);

// ENDPOINT HOTEL
Route::get('/rekomendasi-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'listRekomendasiHotel']);
Route::get('/list-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'listHotel']);
Route::get('/search-hotel', [App\Http\Controllers\Api\ApiHotelController::class, 'searchHotel']);
Route::get('/detail-hotel/{id}', [App\Http\Controllers\Api\ApiHotelController::class, 'detailHotel']);

Route::post('/post-pemesanan', [App\Http\Controllers\Api\ApiPemesananController::class, 'pemesanan']);
