@extends('dashboard-template')

@section('tittle','matakuliah')

@section('content')
    <div class="row p-3 pt-4 pb-1">
      <div class="col-7">

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
                <th scope="col">Semester</th>
                <th scope="col">SKS</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody class="border-0">
              @foreach ($matkuls as $matkul)
                  <tr>
                    <th>{{ $loop->index+1+($matkuls->currentPage()-1)*10 }}</th>
                    <th>{{ $matkul->kode }}</th>
                    <th>{{ $matkul->nama_mata_kuliah }}</th>
                    <th> {{ $matkul->semester }} </th>
                    <th> {{ $matkul->sks }} </th>
                    <th> {{ $matkul->status_mk }} </th>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {{ $matkuls->links() }}
          </div>
    </div>
@endsection
