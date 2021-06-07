<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function verifyLogin(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('siswa.dashboard');
        }
        return redirect()->route('auth.login')->with('danger','Gagal Login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login')->with('success','Berhasil Logout');
    }
}
