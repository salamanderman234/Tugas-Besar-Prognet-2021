@extends('dashboard-template')

@section('tittle','Tambah KRS')

@section('content')
<script src="/js/script.js"></script>
<link rel="stylesheet" href="/css/style.css">
<div class="konten container-fluid p-0 h-100">
    <div class="row p-3 pt-4 pb-1">
        <div class="col-7 ps-0">
            <form action=" {{ route('simpan_krs') }} " method="POST" class="p-0">
                @csrf
                <input id="listKrs" type="text" hidden name="listKrs" value="0">
                <input id="semesterKrs" type="text" hidden name="semesterKrs" value="0">
                <a href="{{ route('krs') }}" class="btn btn-danger" onclick="krs_ajukan()">
                  Kembali
                </a>
                <button type="submit" class="btn btn-success" onclick="krs_ajukan()">
                    Ajukan
                </button>
            </form>
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
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="border-0">
                @foreach ($matkuls as $matkul)
                    <tr>
                      <td>{{ $loop->index+1+($matkuls->currentPage()-1)*8 }}</td>
                      <td>{{ $matkul->kode }}</td>
                      <td>{{ $matkul->nama_mata_kuliah }}</td>
                      <td> {{ $matkul->semester }} </td>
                      <td> {{ $matkul->sks }} </td>
                      <td>
                          <button value="{{ $matkul->id }}" id="{{ $loop->index + 1 }}" class="tambah btn btn-success" onclick="krs_tambah(this.id)">
                              Tambah
                          </button> 
                          <input hidden value="{{ $matkul->sks }}" id="sks-{{ $loop->index + 1 }}">
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $matkuls->links() }}
            </div>
      </div>
</div>
<script src="/js/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    //untuk inisialisasi localStorage jika kosong
    if(!localStorage['krs']){
      let temp = {list:[],max:10};
      localStorage['krs'] = JSON.stringify(temp);
    }
    //menghitung banyak sks yang sudah diambil
    
    //mencari data dari localStorage
    let krs_cache = JSON.parse(localStorage['krs']).list; 
    let krs_maks = JSON.parse(localStorage['krs']).max;
    let krs_len = parseInt(localStorage['krs_len']);
    //untuk mengecek krs yang sudah ada di localStorage
    for(var i=1;i<= {{ count($matkuls) }};i++){
        if(krs_cache.includes(Number($('#'+i).val()))){
          $('#'+i).removeClass( "btn-success" ).addClass('btn-danger').text('Hapus');
        }
    }

    $('#search').on('keyup',function(){
      let url = '{{ route("cari_matkul",["cari"=>"nilai"]) }}'.replace('nilai',$('#search').val());
      if($('#search').val()){
          $('.pagination').hide();
      }else {
          $('.pagination').show();
      }
      ajax_search('tbody',url,6);
    });
  }); 
</script>
@endsection