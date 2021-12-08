@extends('admin.dashboard')
@section('tittle','Profile')
@section('content')
<div class="data-profile row h-100 d-flex align-items-center justify-content-center">
  <div class="col-6 mb-3 me-3 shadow rounded p-3">
      {{-- foto profile --}}
    <div class="row justify-content-center flex-wrap p-2">
      <img class="w-25 rounded-circle" src="image/mahasiswa/{{ $admin->foto_mahasiswa }}" alt="image/user1.jpg" style="weight:100px; height:100px">
    </div>
    {{-- data --}}
    <form class="row p-0 m-0" action="{{ route('ubah_admin') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" class="form-control rounded-0" id="nama" placeholder="Nama" value="ADMIN" readonly>
      </div>
      <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control rounded-0" id="alamat" placeholder="Apartment, studio, or floor" value="{{ $admin->alamat }}" name="alamat">
      </div>
      <div class="form-group ">
          <label for="telepon">No. Telp</label>
          <input type="text" class="form-control rounded-0" id="telepon" placeholder="No. Telepon" value="{{ $admin->telepon }}" name="telepon">
      </div>
      <div class="form-group mb-4">
        <label for="pass">Ganti Password</label>
        <input type="text" class="form-control rounded-0" id="pass" placeholder="Password Baru" name="password_mahasiswa">
      </div>
      <div class="col d-flex justify-content-center p-0 me-1 mb-3">
        <button type="submit" class="simpan btn btn-primary py-1 w-25">Perbaharui</button>
      </div>
    </form>
  </div>
</div>
@endsection
