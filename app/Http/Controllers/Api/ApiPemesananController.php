<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Pemesanan;
use Exception;
use Illuminate\Http\Request;

class ApiPemesananController extends Controller
{
    //insert data pemesanan
    public function pemesanan(Request $request)
    {
        $id_hotel = $request->id_hotel;
        $nama_pemesan = $request->nama_pemesan;
        $email_pemesan = $request->email_pemesan;
        $telepon_pemesan = $request->telepon_pemesan;
        $tipe_kamar = $request->tipe_kamar;
        $metode_pembayaran = $request->metode_pembayaran;

        try {
            // cek dulu data hotelny ada atau tidak
            $hotel = Hotel::find($id_hotel);
            if (!$hotel) {
                // outputnya berupa data bertipe JSON (format standar API zaman sekarang)
                return response()->json([
                    'success' => false,
                    'message' => "Data not found",
                ], 404);
            } else {
                $harga = $hotel->harga;

                // insert datanya ke database
                Pemesanan::create([
                    'hotel_id' => $id_hotel,
                    'nama_pemesan' => $nama_pemesan,
                    'email_pemesan' => $email_pemesan,
                    'tipe_kamar' => $tipe_kamar,
                    'tlp_pemesan' => $telepon_pemesan,
                    'metode_pembayaran' => $metode_pembayaran,
                    'totalharga' => $harga,
                    'tgl_transaksi' => date('Y-m-d')
                ]);

                return response()->json([
                    'success' => true,
                    'message' => "Insert Successfully",
                ], 200);
            }
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => "Fail : " . $error->getMessage(),
            ], 500);
        }
    }
}
