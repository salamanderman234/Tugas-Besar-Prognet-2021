@extends('admin.dashboard')
@section('tittle','Edit Mahasiswa')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_edit_mahasiswa',$mahasiswa->id)}}" method="post">
            @csrf
            <div class="container-fluid d-flex justify-content-center">
                <img class="w-25 border" src="{{ URL::asset('/image/user1.png') }}" alt="{{ URL::asset('/image/user1.png') }}">
            </div>
            <div class="form-group">
              <label for="nim">NIM</label>
              <input type="text" class="form-control rounded-0 @error('nim') is-invalid @enderror" id="nim" placeholder="Nim" value="{{ $mahasiswa->nim }}" name="nim">
              @error('nim')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" class="form-control rounded-0 @error('nama') is-invalid @enderror" id="nama" placeholder="Nama" value="{{ $mahasiswa->nama }}" name="nama">
              @error('nama')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="password_mahasiswa">Password</label>
                <input type="text" class="form-control rounded-0 @error('password_mahasiswa') is-invalid @enderror" id="password_mahasiswa" placeholder="Password Baru" name="password_mahasiswa">
                @error('password_mahasiswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
              <label for="angkatan">Angkatan</label>
              <input type="text" class="form-control rounded-0 @error('angkatan') is-invalid @enderror" id="angkatan" placeholderalamatngkatan" value="{{ $mahasiswa->angkatan }}" name="angkatan">
              @error('angkatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control rounded-0 @error('alamat') is-invalid @enderror" id="alamat" placeholder="Alamat" value="{{ $mahasiswa->alamat }}" name="alamat">
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" class="form-control rounded-0 @error('telepon') is-invalid @enderror" id="telepon" placeholder="Telepon" value="{{ $mahasiswa->telepon }}" name="telepon">
                @error('telepon')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group mb-4">
              <label for="prodi">Program Studi</label>
              <select class="form-control" name="program_studi" id="prodi">
                  @foreach (['Teknologi Informasi','Teknik Mesin','Teknik Industri','Teknik Elektro','Teknik Arsitektur'] as $prodi)
                      <option value="{{ $prodi }}"
                        @if ($mahasiswa->prodi == $prodi)
                          {{ "selected" }}
                        @endif
                      >{{ $prodi }}</option>
                  @endforeach
              </select>
            </div>
            <div class="col d-flex justify-content-center p-0 me-1 mb-3">
              <button type="submit" class="simpan btn btn-primary py-1 w-25">Simpan</button>
              <a type="submit" href="{{ route('daftar_mahasiswa') }}" class="simpan btn btn-danger py-1 w-25 ms-3">Kembali</a>
            </div>
          </form>
    </div>
</div>
@endsection