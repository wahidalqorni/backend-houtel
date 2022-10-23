<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KotaController extends Controller
{
    public function index() {
        $data = Kota::orderBy('nama_kota','ASC')->get();
        return view('kota.index', compact('data') );
    }

    // untuk menampilkan form tambah
    public function add()
    {
        return view('kota.add');
    }

    // untuk proses simpan data
    public function store(Request $request)
    {
        // isert data menggunakan teknik eloquent
        // Kota => merupakan nama class dari Model (Kota)
        $pathGambar = $request->file('gambar')->store('kota-images');

        $kota = Kota::create([
            'nama_kota' => request('nama_kota'),
            'status' => request('status'),
            'gambar' => $pathGambar
        ]);
        // biasanya hasil dari create itu merupakan true or false
        if($kota) {
            return redirect('kota'); // redirect ke routing yg namanya kota ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk menampilkan form edit
     // edit/menampilkan data sesuai yg dipilh itu memerlukan parameter rujukan (id)
    public function edit($id)
    {
        // query data berdasarkan id yg dipilih = $id
        $data = Kota::find($id); // SELECT * FROM kotas WHERE id = variabel $id yg ada di parameter
        return view('kota.edit', compact('data'));
    }

    // untuk proses update data
    public function update(Request $request)
    {
        // ambil data berdasarkan yg dikirim oleh form edit
        $kota = Kota::find($request->id);

        // jika gambar baru diupload
        if($request->file('gambar')){
            // hapus gambar lama
            Storage::delete($kota->gambar);
            // $pathGambar akan mengupload file
            $pathGambar = $request->file('gambar')->store('kota-images');

            // jika tidak upload
        } else {
            // $pathGambar ini isinya value yg ada di field gambar pd tabel kotas
            $pathGambar = $kota->gambar;
        }

        $data = Kota::where('id',$request->id);

        // update data ke tabel
        $update = $data->update([
            'nama_kota' => $request->nama_kota,
            'status' => $request->status,
            'gambar' => $pathGambar
        ]);

        if($update) {
            return redirect('kota'); // redirect ke routing yg namanya kota ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk proses hapus data
    public function destroy($id)
    {
        $kota = Kota::find($id);

        // hapus file gambar data kota berdasarkan id yg dipilih
        Storage::delete($kota->gambar);

        // hapus data kota berdasarkan id yg dipilih
        Kota::destroy($id); // DELETE FROM kotas WHERE id = $id
        return redirect('kota');
    }
}
