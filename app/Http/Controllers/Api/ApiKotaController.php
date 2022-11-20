<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;

class ApiKotaController extends Controller
{
    //function menampilkan data Kota
    public function listKota()
    {
        // buat variabel untuk menampung hasil query tabel kotas
        $kota = Kota::orderBy('nama_kota','ASC')->get();

        // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
        return response()->json([
            'success' => true,
            'message' => "Success",
            'kota'    => $kota
        ]);

    }
}
