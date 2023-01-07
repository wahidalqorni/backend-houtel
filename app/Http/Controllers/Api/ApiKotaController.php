<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Exception;
use Illuminate\Http\Request;

class ApiKotaController extends Controller
{
    //function menampilkan data Kota
    public function listKota()
    {
        try {
            $data = [];
            // buat variabel untuk menampung hasil query tabel kotas
            $kota = Kota::orderBy('nama_kota', 'ASC')->get();
            foreach ($kota as $kt) {
                $data[] = [
                    'id' => $kt->id,
                    'nama_kota' => $kt->nama_kota,
                    'status' => $kt->status,
                    'gambar' => asset('storage/' . $kt->gambar)
                ];
            }
            // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
            return response()->json([
                'success' => true,
                'message' => "Success",
                'kota'    => $kota
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Fail : " . $error->getMessage(),
                'kota' => null
            ], 500);
        }
    }
}
