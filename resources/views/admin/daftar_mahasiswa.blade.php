@extends('admin.dashboard')

@section('tittle','matakuliah')

@section('content')
<table class="table">
    <div class="row p-3 pt-4 pb-1">
      <div class="col-7">

            <a type="button" class="btn btn-primary"href="/new">Add New Mahasiswa</a>
      </div>
      <div class="col-5 pe-0">
        <form class="mb-3 mb-lg-0 d-flex justify-content-end">
          <input type="search" class="form-control form-control-dark w-75" placeholder="Cari Mahasiswa" aria-label="Search">
        </form>
      </div>
    </div>
    <div class="row p-3 pt-0 mt-2">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Mahasiswa</th>
                <th scope="col">NIM</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Angkatan</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="border-0">
              @foreach ($mahasiswas as $mahasiswa)
                  <tr>
                    <th>{{ $loop->index+1+($mahasiswas->currentPage()-1)*10 }}</th>
                    <th>{{ $mahasiswa->nama }}</th>
                    <th>{{ $mahasiswa->nim }}</th>
                    <th> {{ $mahasiswa->program_studi }} </th>
                    <th> {{ $mahasiswa->angkatan }} </th>
                    <th>
                        <form>
                            <div class="btn-group" role="group" aria-label="Basic example">
                            @csrf
                            <a type="button" class="btn btn-primary px-4"href="">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </th>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {{ $mahasiswas->links() }}
          </div>
    </div>
@endsection
