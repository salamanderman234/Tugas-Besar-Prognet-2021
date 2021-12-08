<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Transaksi;
use App\Models\MataKuliah;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil data mata kuliah dan juga mengambil data transaksi yang dibutuhkan seperti status krs
        $krs = MataKuliah::krsMahasiswa(auth()->user()->id);
        //mengambil data semester dan tahun krs
        $tahun_ajaran = $krs->select('tahun_ajaran','transaksis.semester')->groupBy('tahun_ajaran','transaksis.semester')->orderBy('transaksis.semester')->get();
        $tahun_ajaran_sekarang = null;
        //mengambil data tahun ajaran sekarang
        if(!($krs->get()->toArray() == null)){
            if(((int)date('m')>6 && $krs->get()->toArray()[0]['semester']%2==0) || ((int)date('m')<=6 && $krs->get()->toArray()[0]['semester']%2!=0) || (date('Y') != $krs->get()->toArray()[0]['tahun_ajaran'])){
                // if(date('Y') == $krs->get()->toArray()[0]['tahun_ajaran']){
                    // dd($krs->get()->toArray()[0]['semester']);
                    if((int)date('m')<=6){
                        $tahun_ajaran_sekarang = [
                            'semester' => 'Genap',
                            'tahun_ajaran' => (string)(((integer)date('Y'))-1).'/'.date('Y')
                            ,'value' => $krs->get()->toArray()[0]['semester'] + 1
                        ];
                    }
                    else {
                        $tahun_ajaran_sekarang = [
                            'semester' => 'Ganjil',
                            'tahun_ajaran' => date('Y').'/'.(string)(((integer)date('Y'))+1),
                            'value' => $krs->get()->toArray()[0]['semester'] + 1
                        ];
                    }
                // }
            }
        }else {
            if((int)date('m')<=6){
                $tahun_ajaran_sekarang = [
                    'semester' => 'Genap',
                    'tahun_ajaran' => (string)(((integer)date('Y'))-1).'/'.date('Y')
                    ,'value' => 1
                ];
            }
            else {
                $tahun_ajaran_sekarang = [
                    'semester' => 'Ganjil',
                    'tahun_ajaran' => date('Y').'/'.(string)(((integer)date('Y'))+1),
                    'value' => 1
                ];
            }
        }
        
        return view('mahasiswa.krs',[
            'tahun_ajarans' => $tahun_ajaran,
            'tahun_ajaran_sekarang' => $tahun_ajaran_sekarang
        ]);
    }

    public function krsMahasiswa(){
        // dd(request()->semester);
        $krs = MataKuliah::krsMahasiswa(auth()->user()->id)->where('transaksis.semester','=',request()->semester)->get();
        return response()->json([
            "krs"=> $krs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiRequest  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
