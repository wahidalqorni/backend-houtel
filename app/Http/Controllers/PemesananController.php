<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    public function index()
    {
        // SELECT pemesanans.*, hotels.nama_hotel FROM pemesanans JOIN hotels ON hotels.id = pemesanans.hotel_id
        $data = DB::table('pemesanans')
            ->select(DB::raw('pemesanans.*, hotels.nama_hotel ')) // select field apa saja yg dibutuhkan
            ->join('hotels', 'hotels.id', 'pemesanans.hotel_id')
            ->get();

        return view('pemesanan.index', compact('data'));
    }
}
