@extends('admin.dashboard')
@section('tittle','Tambah Mahasiswa')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_tambah_mahasiswa')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="nim">Nim</label>
              <input type="text" value="{{ old('nim') }}" class="form-control rounded-0 @error('nim') is-invalid @enderror" id="nim" placeholder="nim" name="nim">
              @error('nim')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" value="{{ old('nama') }}" class="form-control rounded-0 @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" name="nama">
              @error('nama')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="text" value="{{ old('password_mahasiswa') }}" class="form-control rounded-0 @error('password_mahasiswa') is-invalid @enderror" id="password" placeholder="Password" name="password_mahasiswa">
              @error('password_mahasiswa')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" value="{{ old('alamat') }}" class="form-control rounded-0 @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" name="alamat">
                @error('alamat')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" value="{{ old('telepon') }}" class="form-control rounded-0 @error('telepon') is-invalid @enderror" id="telepon" placeholder="Telepon" name="telepon">
                @error('telepon')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
              </div>
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="text" value="{{ old('angkatan') }}" class="form-control rounded-0 @error('angkatan') is-invalid @enderror" id="angkatan" placeholder="Angkatan" name="angkatan">
                @error('angkatan')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            <div class="form-group mb-4">
              <label for="prodi">Program Studi</label>
              <select class="form-control" name="program_studi" id="prodi">
                  @foreach (['Teknologi Informasi','Teknik Mesin','Teknik Industri','Teknik Elektro','Teknik Arsitektur'] as $prodi)
                      <option value="{{ $prodi }}">{{ $prodi }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col d-flex justify-content-center p-0 me-1 mb-3">
              <button type="submit" class="simpan btn btn-success py-1 w-25">Tambah</button>
              <a role="button" href="{{ route('daftar_mahasiswa') }}" class="simpan btn btn-danger py-1 w-25 ms-3">Kembali</a>
            </div>
        </form>
    </div>
</div>   
@endsection