<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data1 = User::all(); // SELECT * FROM users
        $data = User::orderBy('name','ASC')->get(); // SELECT * FROM users ORDER BY name ASC

        return view('user.index', compact('data','data1') ); // mengambil data sesuai database (table)
    }

    // untuk menampilkan form tambah
    public function add()
    {
        return view('user.add');
    }

    // untuk proses simpan data
    public function store()
    {  
        // VALIDASI
        request()->validate([
            // apa saja yg divalidasi
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5',
            'level' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'email.required' => 'Email harus diisi!',
            'email.unique' => 'Email telah digunakan!',
            'password.required' => 'Password harus diisi!',
            'password.min' => 'Password min. 5 Karakter',
            'level.required' => 'Level harus diisi!'
        ] );

        // isert data menggunakan teknik eloquent
        // User => merupakan nama class dari Model (User)
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => Hash::make( request('password')),
            'level' => request('level')
        ]);
        // biasanya hasil dari create itu merupakan true or false
        if($user) {
            return redirect('user'); // redirect ke routing yg namanya user ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk menampilkan form edit
     // edit/menampilkan data sesuai yg dipilh itu memerlukan parameter rujukan (id)
    public function edit($id)
    {
        // query data berdasarkan id yg dipilih = $id
        $data = User::find($id); // SELECT * FROM users WHERE id = variabel $id yg ada di parameter
        return view('user.edit', compact('data'));
    }

    // untuk proses update data
    public function update(Request $request)
    {

        // VALIDASI
        request()->validate([
            // apa saja yg divalidasi
            'name' => 'required',
            'level' => 'required',
        ], [
            'name.required' => 'Nama harus diisi!',
            'level.required' => 'Level harus diisi!'
        ] );

        // ambil data berdasarkan yg dikirim oleh form edit
        $data = User::where('id',$request->id);

        // update data ke tabel
        $update = $data->update([
            'name' => $request->name,

            // jika form password kosong, maka yg akan diinput adalah data lama di tabel
            // jika form password diisi, maka replace data lama dgn data yg diinputkan dr form
            'password' => $request->password == '' ? $data->first()->password : Hash::make($request->password),
            'level' => $request->level
        ]);

        if($update) {
            return redirect('user'); // redirect ke routing yg namanya user ssuai di web.php
        } else {
            return redirect()->back(); // redirect ke halaman itulah / kembali ke situlah
        }
    }

    // untuk proses hapus data
    public function destroy($id)
    {
        User::destroy($id); // DELETE FROM users WHERE id = $id
        return redirect('user'); 
    }

}
