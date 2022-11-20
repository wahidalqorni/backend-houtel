<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiHotelController extends Controller
{
    public function listHotel()
    {
        $hotel = DB::table('hotels')
            ->select(DB::raw('hotels.*, kotas.nama_kota ')) // select field apa saja yg dibutuhkan
            ->join('kotas', 'kotas.id', 'hotels.kota_id')
            ->get();

        // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
        return response()->json([
            'success' => true,  
            'message' => "Success",
            'hotel'    => $hotel
        ]);
    }
}
