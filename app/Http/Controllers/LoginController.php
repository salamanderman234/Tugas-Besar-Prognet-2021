<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        $credentials = request()->validate([
            'nim' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)){
            request()->session()->regenerate();

            return redirect()->intended('/profile');
        } else {
            return back()->with('login_error','NIM atau Password Salah');
        }
    }
}
