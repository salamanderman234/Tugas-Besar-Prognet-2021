<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(){
        return view('mahasiswa.login');
    }

    public function login(){
        $credentials = request()->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            request()->session()->regenerate();
            return redirect()->intended(route('profile',Auth::id()));
        } else {
            return back()->with('login_error','NIM atau Password Salah');
        }
    }
}
