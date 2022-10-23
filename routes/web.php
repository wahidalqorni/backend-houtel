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
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);
Route::get('/add-user', [App\Http\Controllers\UserController::class, 'add']);
Route::post('/store-user', [App\Http\Controllers\UserController::class, 'store']); 
Route::get('/edit-user/{id}', [App\Http\Controllers\UserController::class, 'edit']); 
Route::post('/update-user', [App\Http\Controllers\UserController::class, 'update']); 
Route::get('/delete-user/{id}', [App\Http\Controllers\UserController::class, 'destroy']); 

Route::get('/kota', [App\Http\Controllers\KotaController::class, 'index']);
Route::get('/add-kota', [App\Http\Controllers\KotaController::class, 'add']);
Route::post('/store-kota', [App\Http\Controllers\KotaController::class, 'store']); 
Route::get('/edit-kota/{id}', [App\Http\Controllers\KotaController::class, 'edit']); 
Route::post('/update-kota', [App\Http\Controllers\KotaController::class, 'update']); 
Route::get('/delete-kota/{id}', [App\Http\Controllers\KotaController::class, 'destroy']); 