@extends('admin.dashboard')
@section('tittle','Tambah Mata Kuliah')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_tambah')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="kode">Kode</label>
              <input type="text" class="form-control rounded-0" id="kode" placeholder="Kode" name="kode">
            </div>
            <div class="form-group">
              <label for="nama">Mata Kuliah</label>
              <input type="text" class="form-control rounded-0" id="nama" placeholder="Mata Kuliah" name="nama_mata_kuliah">
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <input type="text" class="form-control rounded-0" id="semester" placeholder="Semester" name="semester">
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="text" class="form-control rounded-0" id="sks" placeholder="SKS" name="sks">
            </div>
            <div class="form-group">
              <label for="prodi">Program Studi</label>
              <select class="form-control" name="prodi" id="prodi">
                  @foreach (['Teknologi Informasi','Teknik Mesin','Teknik Industri','Teknik Elektro','Teknik Arsitektur'] as $prodi)
                      <option value="{{ $prodi }}">{{ $prodi }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group mb-4">
                <label for="status">Status</label>
                <select name="status_mk" id="status" class="form-control">
                    <option value="Wajib">Wajib</option>
                    <option value="Pilihan">Pilihan</option>
                </select>
              </div>
            <div class="col d-flex justify-content-center p-0 me-1 mb-3">
              <button type="submit" class="simpan btn btn-success py-1 w-25">Tambah</button>
            </div>
          </form>
    </div>
</div>   
@endsection