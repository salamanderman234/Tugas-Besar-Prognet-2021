@extends('admin.dashboard')
@section('tittle','Edit Mata Kuliah')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_edit_matkul',$matkul->id)}}" method="post">
            @csrf
            <div class="form-group">
              <label for="kode">Kode</label>
              <input type="text" class="form-control rounded-0 @error('kode') is-invalid @enderror" id="kode" placeholder="Kode" value="{{ $matkul->kode }}" name="kode">
              @error('kode')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Mata Kuliah</label>
              <input type="text" class="form-control rounded-0 @error('nama_mata_kuliah') is-invalid @enderror" id="nama" placeholder="Mata Kuliah" value="{{ $matkul->nama_mata_kuliah }}" name="nama_mata_kuliah">
              @error('nama_mata_kuliah')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <input type="text" class="form-control rounded-0 @error('semester') is-invalid @enderror" id="semester" placeholder="Semester" value="{{ $matkul->semester }}" name="semester">
              @error('semester')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="sks">SKS</label>
                <input type="text" class="form-control rounded-0 @error('sks') is-invalid @enderror" id="sks" placeholder="SKS" value="{{ $matkul->sks }}" name="sks">
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
                      <option value="{{ $prodi }}"
                        @if ($matkul->prodi == $prodi)
                          {{ "selected" }}
                        @endif
                      >{{ $prodi }}</option>
                  @endforeach
              </select>
            </div>
            <div class="form-group mb-4">
                <label for="status">Status</label>
                <select name="status_mk" id="status" class="form-control">
                    <option value="Wajib"
                        @if ($matkul->status == "Wajib")
                        {{ "selected" }}
                        @endif
                    >Wajib</option>
                    <option value="Pilihan"
                        @if ($matkul->status == "Pilihan")
                            {{ "selected" }}
                        @endif
                    >Pilihan</option>
                </select>
              </div>
            <div class="col d-flex justify-content-center p-0 me-1 mb-3">
              <button type="submit" class="simpan btn btn-primary py-1 w-25">Simpan</button>
              <a type="submit" href="{{ route('daftar_matkul') }}" class="simpan btn btn-danger py-1 w-25 ms-3">Kembali</a>
            </div>
          </form>
    </div>
</div>
@endsection