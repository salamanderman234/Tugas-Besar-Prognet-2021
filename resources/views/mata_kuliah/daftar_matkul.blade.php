@extends('dashboard-template')

@section('tittle','matakuliah')

@section('content')
    <div class="row p-3 pt-4 pb-1">
      <div class="col-7">

      </div>
      <div class="col-5 pe-0">
        <form class="mb-3 mb-lg-0 d-flex justify-content-end">
          <input id="search" type="search" class="form-control form-control-dark w-75" placeholder="Cari Matakuliah" aria-label="Search">
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
                    <td>{{ $loop->index+1+($matkuls->currentPage()-1)*8 }}</td>
                    <td>{{ $matkul->kode }}</th>
                    <td>{{ $matkul->nama_mata_kuliah }}</td>
                    <td> {{ $matkul->semester }} </td>
                    <td> {{ $matkul->sks }} </td>
                    <td> {{ $matkul->status_mk }} </td>
                  </tr>
              @endforeach
            </tbody>
          </table>
          <div class="d-flex justify-content-center" hidden>
            {{ $matkuls->links() }}
          </div>
    </div>
<script src="js/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>
<script>
  $(document).ready(function(){
    $('#search').on('keyup',function(){
       let url = '{{ route("cari_matkul",["cari"=>"nilai"]) }}'.replace('nilai',$('#search').val());
       if($('#search').val()){
          $('.pagination').hide();
       }else {
          $('.pagination').show();
       }
       ajax_search('tbody',url);
    });
  }); 
</script>
@endsection
