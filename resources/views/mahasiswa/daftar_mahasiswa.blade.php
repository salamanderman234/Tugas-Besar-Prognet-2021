@extends('admin.dashboard')

@section('tittle','Daftar Mahasiswa')

@section('content')
  <div class="atas row ps-1 @if(!session()->has('pesan')){{ 'pt-4' }} @endif pb-1">
    <div class="col-7">
      <a role="button" class="btn btn-success" href="{{ route('tambah_mahasiswa') }}">Tambah</a>
    </div>
    <div class="col-5 pe-0 pe-3">
      <form action="{{ route('daftar_mahasiswa') }}" method="GET" class="mb-3 mb-lg-0 d-flex justify-content-end">
        <input name="search" id="search" type="search" class="form-control form-control-dark w-75" placeholder="Cari Matakuliah" aria-label="Search">
      </form>
    </div>
  </div>
  <div class="row p-3 pt-0 mt-2">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
              <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Nama Mahasiswa</th>
                <th class="text-center" scope="col">NIM</th>
                <th class="text-center" scope="col">Program Studi</th>
                <th class="text-center" scope="col">Angkatan</th>
                <th class="text-center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody class="border-0">
              @foreach ($mahasiswas as $mahasiswa)
                  <tr>
                    <td class="text-center">{{ $loop->index+1+($mahasiswas->currentPage()-1)*10 }}</td>
                    <td class="text-center">{{ $mahasiswa->nama }}</td>
                    <td class="text-center">{{ $mahasiswa->nim }}</td>
                    <td class="text-center"> {{ $mahasiswa->program_studi }} </td>
                    <td class="text-center"> {{ $mahasiswa->angkatan }} </td>
                    <td class="d-flex justify-content-center">
                        <form action="{{ route('hapus_mahasiswa',$mahasiswa->id) }}" method="post" onsubmit ="return persetujuan()">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            @csrf
                            <a type="button" class="btn btn-primary px-4"href="{{ route('edit_mahasiswa',$mahasiswa->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {{ $mahasiswas->links() }}
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
