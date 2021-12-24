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
        request()->validate([
            'alamat' => 'required|max:255',
            'telepon' => 'required|max:20',
            'foto_mahasiswa'=>'image|max:5120|mimes:jpg,png,jpeg'
        ]);
        
        $admin = Mahasiswa::find(auth()->user()->id);
        $admin->alamat = request()->alamat;
        $admin->telepon = request()->telepon;
        if(isset(request()->password_mahasiswa)){
            $admin->password_mahasiswa = bcrypt(request()->password_mahasiswa);
        }
        if(request()->file('foto_mahasiswa')){
            $admin->foto_mahasiswa = request()->file('foto_mahasiswa')
                                              ->store('profile-mahasiswa');
        }
        $admin->save();
        return redirect()->route('admin')->with([
            'jenis_pesan'=>'success',
            'pesan'=>'Data Berhasil Diperbaharui !'
        ]);
    }
}
