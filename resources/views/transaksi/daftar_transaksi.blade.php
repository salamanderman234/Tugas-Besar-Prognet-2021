@extends('admin.dashboard')

@section('tittle','Daftar Transaksi')

@section('content')

  <div class="atas row ps-1 @if(!session()->has('pesan')){{ 'pt-4' }} @endif pb-1">
    <div class="col-7">
      <a href="{{ route('tambah_transaksi') }}" role="button" class="btn btn-success">
          Tambah        
      </a>
    </div>
    <div class="col-5 pe-0 pe-3 ">
      <form action="{{ route('daftar_transaksi') }}" method="GET" class="mb-3 mb-lg-0 d-flex justify-content-end">
        <input name="search" id="search" type="search" class="form-control form-control-dark w-75" placeholder="Cari Transaksi" aria-label="Search">
      </form>
    </div>
  </div>
  <div class="row p-3 pt-0 mt-2">
        <table class="table table-striped">
            <thead class="bg-primary text-light">
              <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Tahun Ajaran</th>
                <th class="text-center" scope="col">Id Mahasiswa</th>
                <th class="text-center" scope="col">Id Mata Kuliah</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center  px-0" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody class="border-0">
              @foreach ($transaksis as $transaksi)
                  <tr>
                    <td class="text-center">{{ $loop->index+1+($transaksis->currentPage()-1)*10 }}</td>
                    <td class="text-center">{{ $transaksi->tahun_ajaran }}</td>
                    <td class="text-center">{{ $transaksi->mahasiswa_id }}</td>
                    <td class="text-center"> {{ $transaksi->mata_kuliah_id }} </td>
                    <td class="text-center"> {{ $transaksi->status }} </td>
                    <td class="d-flex justify-content-center  px-0">
                        <form action="{{ route('hapus_transaksi',$transaksi->id) }}" method="post" onsubmit ="return persetujuan()">
                            <div class="btn-group" role="group" aria-label="Basic example">
                            @csrf
                            <a type="button" class="btn btn-primary px-4 rounded-start"href="{{ route('edit_transaksi',$transaksi->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>
                    </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center">
            {{ $transaksis->links() }}
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