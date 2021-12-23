@extends('admin.dashboard')
@section('tittle','Daftar Mata Kuliah')
@section('content')
<div class="atas row p-3 @if(!session()->has('pesan')){{ 'pt-4' }} @endif pb-1">
    <div class="col-7 ps-0">
      <a role="button" class="btn btn-success" href="{{ route('tambah_matkul') }}">Tambah</a>
    </div>
    <div class="col-5 pe-0">
      <form action="{{ route('daftar_matkul') }}" method="GET" class="mb-3 mb-lg-0 d-flex justify-content-end">
        <input name="search" type="search" class="form-control form-control-dark w-75" placeholder="Cari Matakuliah" aria-label="Search">
      </form>
    </div>
  </div>
  <div class="row p-3 pt-0 mt-2">
      <table class="table table-striped">
          <thead class="bg-primary text-light">
            <tr>
              <th class="text-center" scope="col">No</th>
              <th class="text-center" scope="col">Kode</th>
              <th class="text-center" scope="col">Nama Matakuliah</th>
              <th class="text-center" scope="col">Program Studi</th>
              <th class="text-center" scope="col">Semester</th>
              <th class="text-center" scope="col">SKS</th>
              <th class="text-center" scope="col">Status</th>
              <th class="text-center" scope="col" class=" text-center">Action</th>
            </tr>
          </thead>
          <tbody class="border-0">
            @forelse ($mata_kuliahs as $mata_kuliah)
                <tr>
                  <td class="text-center">{{ $loop->index+1+($mata_kuliahs->currentPage()-1)*8 }}</td>
                  <td class="text-center">{{ $mata_kuliah->kode }}</td>
                  <td class="text-center">{{ $mata_kuliah->nama_mata_kuliah }}</td>
                  <td class="text-center">{{ $mata_kuliah->prodi }}</td>
                  <td class="text-center"> {{ $mata_kuliah->semester }} </td>
                  <td class="text-center"> {{ $mata_kuliah->sks }} </td>
                  <td class="text-center"> {{ $mata_kuliah->status_mk }} </td>
                  <td class="d-flex justify-content-center">
                    <form action="{{ route('hapus_matkul',$mata_kuliah->id) }}" method="post" onsubmit ="return persetujuan()">
                        <div class="btn-group" role="group" aria-label="Basic example">
                        @csrf
                        <a type="button" class="btn btn-primary px-4"href="{{ route('edit_matkul',$mata_kuliah->id) }}">Edit</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                  </td>
                </tr>
            @empty
                <tr>
                  <td colspan="8" class="text-center"> Tidak ada data yang cocok ! </td>
                </tr>
            @endforelse
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {{ $mata_kuliahs->links() }}
        </div>
  </div>
  <script>
        function persetujuan(){
            if(confirm('yakin ingin menghapus ?')){
                return true;
            }else {
                return false;
            }
        }
  </script>
@endsection
