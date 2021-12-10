<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Illuminate\Pagination\Paginator;
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
                    $val = $krs->get()->toArray()[0]['semester'];
                    $tahun = $krs->get()->toArray()[0]['tahun_ajaran'];
                    if($val%2==0){
                        $val += 1;
                    }
                    // dd(((int)date('Y') - $tahun));
                    if((int)date('m')<=6){

                        $tahun_ajaran_sekarang = [
                            'semester' => 'Genap',
                            'tahun_ajaran' => (string)(((integer)date('Y'))-1).'/'.date('Y')
                            ,'value' => $val + ((int)date('Y') - $tahun)
                        ];
                    }
                    else {
                        if(((int)date('Y') - $tahun == 0 && $val % 2 == 0) || 7){
                            $val += 1;
                        }else if(1==1){
                            //
                        }
                        $tahun_ajaran_sekarang = [
                            'semester' => 'Ganjil',
                            'tahun_ajaran' => date('Y').'/'.(string)(((integer)date('Y'))+1),
                            'value' => $val + ((int)date('Y') - $tahun)
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
        $semester = 0;
        return view('mahasiswa.krs',[
            'tahun_ajarans' => $tahun_ajaran,
            'tahun_ajaran_sekarang' => $tahun_ajaran_sekarang,
            'semester' => $semester
        ]);
    }

    public function krsMahasiswa(){
        // dd(request()->semester);
        $krs = MataKuliah::krsMahasiswa(auth()->user()->id)->where('transaksis.semester','=',request()->semester)->get();
        return response()->json([
            "krs"=> $krs
        ]);
    }

    public function tambahKrs(){
        $is_genap = 0;
        if((int)date('m')>6){
            $is_genap=1;
        }
        $matkuls = MataKuliah::where('prodi','=',auth()->user()->program_studi)
                ->whereRaw('semester%2='.(string)$is_genap)
                ->orderBy('semester')
                ->paginate(8);
        Paginator::useBootstrap();
        return view('mahasiswa.tambah_krs',compact('matkuls'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function simpanKrs()
    {
        foreach(explode(',',request()->listKrs) as $krs){
            Transaksi::create([
                'tahun_ajaran' => date('Y'),
                'semester' => (int)request()->semesterKrs,
                'mahasiswa_id' => auth()->user()->id,
                'mata_kuliah_id' => (int)$krs,
                'nilai' => 'Tunda',
                'status' => 'Belum Disetujui'
            ]);
        }
        return redirect()->route('krs');
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
