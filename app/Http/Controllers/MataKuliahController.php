<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMataKuliahRequest;
use App\Http\Requests\UpdateMataKuliahRequest;
use App\Models\MataKuliah;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matkul = MataKuliah::all()->orderBy('semester')->paginate(10);
        Paginator::useBootstrap();
        return view('mata_kuliah.daftar_matkul',compact('matkul'));
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
    public function edit(MataKuliah $mataKuliah)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MataKuliah  $mataKuliah
     * @return \Illuminate\Http\Response
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        //
    }
}
