@extends('dashboard-template')
@section('tittle','dashboard')
@section('content')
<form class="profile p-0 m-0 border h-100">
    <div class="data-profile row h-100 d-flex align-items-center justify-content-center">
        {{-- foto profile --}}
        <div class="col-4 d-flex shadow rounded m-3 p-3" style="max-height: 488px;">
            <div class="container-fluid">
              <div class="row justify-content-center flex-wrap p-2">
                <img class="w-50 rounded-circle" src="image/user1.png" alt="image/user.jpg" style="weight:100px; height:100px">
                <div class="row mt-1">
                  <div class="col d-flex justify-content-end p-0 me-1">
                    <a type="submit" class="simpan btn btn-primary py-1">Perbaharui</a>
                  </div>
                  <div class="col d-flex justify-content-start p-0 ms-1">
                    <a type="#" class="reset btn btn-danger py-1">Reset</a>
                  </div>
                </div>
              </div>
              <div class="dashkrs row border-start border-dark mt-2 mb-2" >
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>
                  <div class="container-fluid">dasdas</div>

              </div>
            </div>
        </div>
        {{-- data mahasiswa --}}
        <div class="col-7 mt-3 mb-3 me-3 shadow rounded p-3">
            
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" class="form-control rounded-0" id="nim" placeholder="NIM">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control rounded-0" id="password" placeholder="Password">
                </div>
                
                <div class="form-group">
                  <label for="nama">Nama Lengkap</label>
                  <input type="text" class="form-control rounded-0" id="nama" placeholder="Nama">
                </div>
                <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" class="form-control rounded-0" id="alamat" placeholder="Apartment, studio, or floor">
                </div>
                {{-- <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control rounded-0" id="inputCity">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2 mb-4">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control rounded-0" id="inputZip">
                  </div>
                </div> --}}
                <div class="form-group">
                    <label for="telepon">No. Telp</label>
                    <input type="text" class="form-control rounded-0" id="telepon" placeholder="No. Telepon">
                </div>
                <div class="form-group">
                    <label for="program_studi">Program Studi</label>
                    <select id="program_studi" class="form-control rounded-0 mb-4 ps-0">
                      <option selected>Teknologi Informasi</option>
                      <option>...</option>
                    </select>
                  </div>
              
        </div>
    </div>
</form>
@endsection