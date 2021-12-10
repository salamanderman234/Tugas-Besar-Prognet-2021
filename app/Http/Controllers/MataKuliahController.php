<?php

namespace App\Http\Controllers;

use App\Support\Collection;
use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use Illuminate\Pagination\Paginator;
use App\Models\MataKuliah;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkuls = MataKuliah::where('prodi','=',auth()->user()->program_studi)->orderBy('semester')->paginate(8);
        Paginator::useBootstrap();
        // dd(json_encode($matkuls));
        return view('mata_kuliah.daftar_matkul',compact('matkuls'));
    }

    public function semua_matkul(){
        $mata_kuliahs = MataKuliah::where('id','!=',0)->orderBy('prodi')->paginate(8);
        Paginator::useBootstrap();
        return view('mata_kuliah.seluruh_matkul',compact('mata_kuliahs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah(){
        return view('mata_kuliah.tambah_matkul');
    }
    public function simpan_tambah()
    {
        MataKuliah::create([
            'kode' => request()->kode,
            'nama_mata_kuliah' => request()->nama_mata_kuliah,
            'semester' => request()->semester,
            'sks' => request()->sks,
            'prodi' => request()->prodi,
            'status_mk' => request()->status_mk
        ]);
        return redirect()->route('daftar_matkul');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMataKuliahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMataKuliahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function show(MataKuliah $mataKuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matkul = MataKuliah::find($id);
        return view('mata_kuliah.edit_matkul',compact('matkul'));
    }

    public function simpanedit($id){
        // dd(request());
        request()->validate([
            'kode' => 'required',
            'nama_mata_kuliah' => 'required',
            'semester' => 'required|numeric',
            'sks' => 'required|numeric',
            'prodi' => 'required',
            'status_mk' => 'required'
        ]);

        $matkul = MataKuliah::find($id);
        $matkul->kode = request()->kode;
        $matkul->nama_mata_kuliah = request()->nama_mata_kuliah;
        $matkul->semester = request()->semester;
        $matkul->sks = request()->sks;
        $matkul->prodi = request()->prodi;
        $matkul->status_mk = request()->status_mk;
        $matkul->save();

        return redirect()->route('daftar_matkul');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMataKuliahRequest  $request
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMataKuliahRequest $request, MataKuliah $mataKuliah)
    {
        //
    }

    public function cari(){
        $matkuls = MataKuliah::select(['kode','nama_mata_kuliah','semester','sks','status_mk'])
                    ->where('prodi','=',auth()->user()->program_studi)
                    ->cari(request()->cari,['kode','nama_mata_kuliah'])->get();
        return json_encode($matkuls);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function hapus($id)
    {
        
        // $matkul = MataKuliah::find($id);
        // dd($matkul->relations);
        // if($matkul->relations != null){
        //     return redirect()->route('daftar_matkul',[
        //         "pesan" => "Terjadi Kesalahan !"
        //     ]);
        // }
        // $matkul->delete();
        // return redirect()->route('daftar_matkul',[
        //     "pesan" => "Hapus Mata Kuliah Berhasil !"
        // ]);
    }
}
