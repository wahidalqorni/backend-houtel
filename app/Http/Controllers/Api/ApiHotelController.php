<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiHotelController extends Controller
{
    // menampilkan list hotel
    public function listHotel()
    {
        try {
            $hotel = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // select field apa saja yg dibutuhkan
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->get();

            // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
            return response()->json([
                'success' => true,
                'message' => "Success",
                'hotel'    => $hotel
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Fail : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }

    // menampilkan hotel berdasarkan id yg dipilih
    public function detailHotel(Request $request)
    {
        // wadah untuk menampung nilai inputan yg bernama id
        $id = $request->id;

        try {
            $hotel = DB::table('hotels')
                ->select(DB::raw('hotels.*, kotas.nama_kota ')) // select field apa saja yg dibutuhkan
                ->join('kotas', 'kotas.id', 'hotels.kota_id')
                ->where('hotels.id', $id)
                ->first();
                
            // jika datanya ada
            if ($hotel) {
                // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
                return response()->json([
                    'success' => true,
                    'message' => "Success",
                    'hotel'    => $hotel
                ], 200);
            } else {
                // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
                return response()->json([
                    'success' => false,
                    'message' => "Data not found",
                    'hotel'    => $hotel
                ], 404);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Fail : " . $error->getMessage(),
                'hotel'    => null
            ], 500);
        }
    }
}
