<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::find(auth()->user()->id);
        return view('mahasiswa.profile',compact('mahasiswa'));
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
    public function create()
    {
        Mahasiswa::create([
            'nim' => '2005551140',
            'nama' => 'I Dogler',
            'password_mahasiswa' => bcrypt('tresna'),
            'alamat' => 'sukawati',
            'telepon' => '0888111882',
            'program_studi' => 'Teknologi Informasi',
            'angkatan' => '2010',
            'foto_mahasiswa' => '//'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaRequest  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
//
    }
}
