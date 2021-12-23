<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile()
    {
        $admin = Mahasiswa::find(auth()->user()->id);
        return view('admin.profile',compact('admin'));
    }

    public function ubah(){
        $admin = Mahasiswa::find(auth()->user()->id);
        $admin->alamat = request()->alamat;
        $admin->telepon = request()->telepon;
        if(isset(request()->password_mahasiswa)){
            $admin->password_mahasiswa = bcrypt(request()->password_mahasiswa);
        }
        $admin->save();
        return redirect()->route('admin',[
            $pesan => "Password Berhasil Diubah !"
        ]);
    }
}
