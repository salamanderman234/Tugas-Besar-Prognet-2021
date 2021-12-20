@extends('admin.dashboard')
@section('tittle','Tambah Mata Kuliah')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_tambah')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="kode">Kode</label>
              <input type="text" value="{{ old('kode') }}" class="form-control rounded-0 @error('kode') is-invalid @enderror" id="kode" placeholder="Kode" name="kode">
              @error('kode')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Mata Kuliah</label>
              <input type="text" value="{{ old('nama_mata_kuliah') }}" class="form-control rounded-0 @error('nama_mata_kuliah') is-invalid @enderror" placeholder="Mata Kuliah" name="nama_mata_kuliah">
              @error('nama_mata_kuliah')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <input type="text" value="{{ old('semester') }}" class="form-control rounded-0 @error('semester') is-invalid @enderror" id="semester" placeholder="Semester" name="semester">
              @error('semester')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="text" value="{{ old('sks') }}" class="form-control rounded-0 @error('sks') is-invalid @enderror" id="sks" placeholder="SKS" name="sks">
                @error('sks')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
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
              <a role="button" href="{{ route('daftar_matkul') }}" class="simpan btn btn-danger py-1 w-25 ms-3">Kembali</a>
            </div>
          </form>
    </div>
</div>   
@endsection