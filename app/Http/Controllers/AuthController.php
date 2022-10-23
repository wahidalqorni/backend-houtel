<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //menampilkan form login
    public function login()
    {
        // memanggil file login.blade.php yg ada di folder auth
        return view('auth.login');
    }
}
