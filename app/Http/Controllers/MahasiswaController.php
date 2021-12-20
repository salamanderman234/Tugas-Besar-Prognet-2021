<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;
use Illuminate\Pagination\Paginator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mahasiswa.profile');
    }
    public function semua_mahasiswa(){
        $mahasiswas = Mahasiswa::where('jabatan','=','mahasiswa');
        if(request()->search){
            $mahasiswas->where('nama','LIKE','%'.request()->search.'%')
                        ->orWhere('nim','LIKE','%'.request()->search.'%')
                        ->orWhere('program_studi','LIKE','%'.request()->search.'%');
        }
        $mahasiswas = $mahasiswas->orderBy('program_studi')->paginate(8);
        Paginator::useBootstrap();
        return view('admin.daftar_mahasiswa',compact('mahasiswas'));
    }
    public function ubah(){
        $mahasiswa = Mahasiswa::find(auth()->user()->id);
        $mahasiswa->alamat = request()->alamat;
        $mahasiswa->telepon = request()->telepon;
        $mahasiswa->save();

        return redirect()->route('profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah()
    {
        return view('mahasiswa.tambah_mahasiswa');      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan_tambah()
    {
        request()->validate([
            'nim'=> 'required|unique:mahasiswas',
            'nama'=>'required',
            'password_mahasiswa'=>'required',
            'alamat'=> 'required',
            'telepon'=>'required|numeric',
            'program_studi'=>'required',
            'angkatan'=>'required|numeric'
        ]);
        Mahasiswa::create([
            'nim' => request()->nim,
            'nama' => request()->nama,
            'password_mahasiswa' => bcrypt(request()->password_mahasiswa),
            'alamat' => request()->alamat,
            'telepon' => request()->telepon,
            'program_studi' => request()->program_studi,
            'angkatan' => request()->angkatan,
            'jabatan'=>'mahasiswa',
            'foto_mahasiswa' => '//'
        ]);
        return redirect()->route('daftar_mahasiswa')->with('berhasil','Mahasiswa Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswa.edit_mahasiswa',compact('mahasiswa'));
    }

    public function simpanedit($id){
        $validate = [
            'nim'=> 'required',
            'nama'=>'required',
            'alamat'=> 'required',
            'telepon'=>'required|numeric',
            'program_studi'=>'required',
            'angkatan'=>'required|numeric'
        ];
        $mahasiswa = Mahasiswa::find($id);
        if(request()->kode!=$mahasiswa->kode){
            $validate['nim'] = 'required|unique:mahasiswas';
        }
        request()->validate($validate);
        $mahasiswa->nim = request()->nim;
        $mahasiswa->nama = request()->nama;
        $mahasiswa->alamat = request()->alamat;
        $mahasiswa->telepon = request()->telepon;
        $mahasiswa->program_studi = request()->program_studi;
        $mahasiswa->angkatan = request()->angkatan;
        if(request()->password_mahasiswa){
            $mahasiswa->password_mahasiswa= bcrypt(request()->password_mahasiswa);
        }
        $mahasiswa->save();

        return redirect()->route('daftar_mahasiswa');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect()->route('daftar_mahasiswa');
    }
}
