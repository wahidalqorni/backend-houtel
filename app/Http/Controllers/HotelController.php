<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HotelController extends Controller
{
    public function index()
    {
        // SELECT hotels.*, kotas.nama_kota FROM hotels JOIN kotas ON kotas.id = hotels.kota_id
        $data = DB::table('hotels')
            ->select(DB::raw('hotels.*, kotas.nama_kota ')) // select field apa saja yg dibutuhkan
            ->join('kotas', 'kotas.id', 'hotels.kota_id')
            ->get();

        return view('hotel.index', compact('data'));
    }

    // untuk menampilkan form tambah
    public function add()
    {
        // ambil data kota, agar di form add hotel kita dapat memilih kota
        $kota = Kota::orderBy('nama_kota', 'ASC')->get();
        return view('hotel.add', compact('kota'));
    }

    // untuk proses simpan data
    public function store(Request $request)
    {
        // Hotel => merupakan nama class dari Model (Hotel)
        $pathGambar = $request->file('gambar')->store('hotel-images');

        // insert data menggunakan teknik eloquent (NamaModel::namaFunction => create, destroy, update)
        $hotel = Hotel::create([
            'nama_hotel' => request('nama_hotel'),
            'alamat' => request('alamat'),
            'gambar' => $pathGambar,
            'kota_id' => request('kota_id'),
            'publish' => request('publish')
        ]);
        // biasanya hasil dari create itu merupakan true or false
        if ($hotel) {
            return redirect('hotel'); // redirect ke routing yg namanya hotel ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk menampilkan form edit
    // edit/menampilkan data sesuai yg dipilh itu memerlukan parameter rujukan (id)
    public function edit($id)
    {
        // query data berdasarkan id yg dipilih = $id
        $data = Hotel::find($id); // SELECT * FROM hotels WHERE id = variabel $id yg ada di parameter

        // ambil data kota, agar di form add hotel kita dapat memilih kota
        $kota = Kota::orderBy('nama_kota', 'ASC')->get();

        return view('hotel.edit', compact('data','kota'));
    }

    // untuk proses update data
    public function update(Request $request)
    {
        // ambil data berdasarkan yg dikirim oleh form edit
        $hotel = Hotel::find($request->id);
        // dd($hotel);
        // jika gambar baru diupload
        if ($request->file('gambar')) {
            // hapus dulu gambar lama
            Storage::delete($hotel->gambar);
            // $pathGambar akan mengupload file yg baru
            $pathGambar = $request->file('gambar')->store('hotel-images');

            // jika tidak upload
        } else {
            // $pathGambar ini isinya value yg ada di field gambar pd tabel hotels
            $pathGambar = $hotel->gambar;
        }

        $data = Hotel::where('id', $request->id);

        // update data ke tabel
        $update = $data->update([
            'nama_hotel' => $request->nama_hotel,
            'alamat' => $request->alamat,
            'gambar' => $pathGambar,
            'kota_id' => $request->kota_id,
            'publish' => $request->publish
        ]);

        if ($update) {
            return redirect('hotel'); // redirect ke routing yg namanya hotel ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk proses hapus data
    public function destroy($id)
    {
        // ambil data berdasarkan yg dikirim dari tombol hapus
        $hotel = Hotel::find($id);

        // hapus file gambar data hotel berdasarkan id yg dipilih
        Storage::delete($hotel->gambar);

        // hapus data hotel berdasarkan id yg dipilih
        Hotel::destroy($id); // DELETE FROM hotels WHERE id = $id
        return redirect('hotel');
    }
}
