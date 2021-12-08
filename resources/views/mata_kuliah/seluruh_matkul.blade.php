@extends('admin.dashboard')
@section('tittle','Daftar Mata Kuliah')
@section('content')
<div class="row p-3 pt-4 pb-1">
    <div class="col-7 ps-0">
      <a role="button" class="btn btn-success" href="{{ route('tambah_matkul') }}">Tambah</a>
    </div>
    <div class="col-5 pe-0">
      <form class="mb-3 mb-lg-0 d-flex justify-content-end">
        <input type="search" class="form-control form-control-dark w-75" placeholder="Cari Matakuliah" aria-label="Search">
      </form>
    </div>
  </div>
  <div class="row p-3 pt-0 mt-2">
      <table class="table table-striped">
          <thead class="bg-primary text-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode</th>
              <th scope="col">Nama Matakuliah</th>
              <th scope="col">Program Studi</th>
              <th scope="col">Semester</th>
              <th scope="col">SKS</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody class="border-0">
            @foreach ($mata_kuliahs as $mata_kuliah)
                <tr>
                  <th>{{ $loop->index+1+($mata_kuliahs->currentPage()-1)*8 }}</th>
                  <th>{{ $mata_kuliah->kode }}</th>
                  <th>{{ $mata_kuliah->nama_mata_kuliah }}</th>
                  <th>{{ $mata_kuliah->prodi }}</th>
                  <th> {{ $mata_kuliah->semester }} </th>
                  <th> {{ $mata_kuliah->sks }} </th>
                  <th> {{ $mata_kuliah->status_mk }} </th>
                  <th>
                    <div class="container-fluid d-flex justify-content-center">
                      <a role="button" class="btn btn-primary" href="{{ route('edit_matkul',$mata_kuliah->id) }}">Edit</a>
                      <form action="//" method="post">
                        @csrf
                        <button type="submit" class="btn btn-danger" href="">Hapus</button>
                      </form>
                    </div>
                  </th>
                </tr>
            @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $mata_kuliahs->links() }}
        </div>
  </div>
@endsection
