<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// default routing '/;
Route::get('/', function () {
    // return view('welcome');

    // memanggil routing login di default routing
    return redirect('login');
});

// route auth

// kiri => routing,  tengah =>file controller disambung dgn :: class,  kanan =>'functionnya'
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/loginProses', [App\Http\Controllers\AuthController::class, 'loginProses']);

// middleware auth utk membatasi akses routing tertentu harus melewati login terlebih dahulu
Route::group(['middleware' => ['auth']], function () {
    // masukkan route apa saja yg ingin dibatasi
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);
    
    // USER
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
    Route::get('/add-user', [App\Http\Controllers\UserController::class, 'add']);
    Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store']);
    Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit']);
    Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update']);
    Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'destroy']);

    // KOTA
    Route::get('/kota', [App\Http\Controllers\KotaController::class, 'index']);
    Route::get('/add-kota', [App\Http\Controllers\KotaController::class, 'add']);
    Route::post('/store-kota', [App\Http\Controllers\KotaController::class, 'store']);
    Route::get('/edit-kota/{id}', [App\Http\Controllers\KotaController::class, 'edit']);
    Route::post('/update-kota', [App\Http\Controllers\KotaController::class, 'update']);
    Route::get('/delete-kota/{id}', [App\Http\Controllers\KotaController::class, 'destroy']);

    // HOTEL
    Route::get('/hotel', [App\Http\Controllers\HotelController::class, 'index']);
    Route::get('/add-hotel', [App\Http\Controllers\HotelController::class, 'add']);
    Route::post('/store-hotel', [App\Http\Controllers\HotelController::class, 'store']);
    Route::get('/edit-hotel/{id}', [App\Http\Controllers\HotelController::class, 'edit']);
    Route::post('/update-hotel', [App\Http\Controllers\HotelController::class, 'update']);
    Route::get('/delete-hotel/{id}', [App\Http\Controllers\HotelController::class, 'destroy']);
});
