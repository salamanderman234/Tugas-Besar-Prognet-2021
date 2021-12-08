@extends('admin.dashboard')

@section('title','new mahasiswa')

@section('content')
    <form action="/savenew" method="POST"enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="NIM" class="form-label">nim</label>
            <input type="text" class="form-control" id="NIM" name="nim">
        </div>

        <div class="mb-3">
            <label for="Name" class="form-label">nama</label>
            <input type="text" class="form-control" id="Name" name="nama">
        </div>

        <div class="mb-3">
            <label for="Password" class="form-label">password_mahasiswa</label>
            <input type="Password" class="form-control" id="average" password="password_mahasiswa">
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">telepon</label>
            <input type="text" class="form-control" id="phone" name="telepon">
        </div>


        <div class="mb-3">
            <label for="programstudi" class="form-label">program_studi</label>
        <select class="mb-3 form-select" aria-label="Default select example" name="program_studi">
            <option selected>Open select menu</option>
            <option value="teknologi informasi">teknologi informasi</option>
            <option value="teknik mesin">Teknik Mesin</option>
            <option value="lainnya">lainnya</option>
        </select>
        </div>

        <div class="mb-3">
            <label for="angkatans" class="form-label">angkatan</label>
        <select class="mb-3 form-select" aria-label="Default select example" name="angkatan">
            <option selected>Open select menu</option>
            @for ($i=0;$i<=3;$i++)
                <option values='{{ date("Y")-$i }}'>{{ date("Y")-$i }}</option>

            @endfor
        </select>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">foto_mahasiswa</label>
            <input class="form-control" type="file" id="picture" name="picture">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a type="button" class="btn btn-secondary" href="/">Back</a>
    </form>
@endsection
