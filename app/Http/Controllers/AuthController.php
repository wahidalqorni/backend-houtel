<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //menampilkan form login
    public function login()
    {
        // jika ada session yg login, maka akan diarahkan ke routing dashboard
        if (Auth::check() == true) {
            // arahkan ke routing yg namanya dashboard
            return redirect('dashboard');

        } else {
            // jika tidak ada session yg login, maka akan ke view auth/login
            // memanggil file login.blade.php yg ada di folder auth
            return view('auth.login');
        }
    }

    public function loginProses(Request $request)
    {
        // data yg akan diinputkan, sesuai name inputan pd form login
        $data = [
            'email'     => $request->input('email'), // name pada inputan email
            'password'  => $request->input('password'), // name pada inputan password
        ];

       
        try {
            // cek kesesuaian data autentikasi login (bawaan laravel)
            Auth::attempt($data);

            if (Auth::check()) { //jika hasilnya true sekalian simpan session field data user yg login
                //Login Success
                return redirect('dashboard');
            } else {
                // Login Gagal
                return redirect()->back()->with([ // kembali ke halaman sebelumnya dan kirim data dengan keyword with (with ini menyimpan data ke session browser web)
                    'error' => "Username / Password Salah"
                ]);
            }
        } catch (Exception $e) {
            // Jika terdapat error, kembalikan ke halaman sebelumnya dan kirim data pesan errorny
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        // menghapus session yg login
        auth()->logout();

        // arahkan ke routing yg namanya login
        return redirect('login');
    }
}
