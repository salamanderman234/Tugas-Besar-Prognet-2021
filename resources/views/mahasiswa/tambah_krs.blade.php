@extends('dashboard-template')

@section('tittle','Tambah KRS')

@section('content')
<link rel="stylesheet" href="/css/style.css">
<div class="konten container-fluid p-0 h-100">
    <div class="row p-3 pt-4 pb-1">
        <div class="col-7 ps-0">
            <form action=" {{ route('simpan_krs') }} " method="POST" class="p-0">
                @csrf
                <input id="list-krs" type="text" hidden name="listKrs" value="0">
                <input id="semester-krs" type="text" hidden name="semesterKrs" value="0">
                <button type="submit" class="btn btn-success" onclick="hapus()">
                    Ajukan
                </button>
            </form>
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
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="border-0">
                @foreach ($matkuls as $matkul)
                    <tr>
                      <th>{{ $loop->index+1 }}</th>
                      <th>{{ $matkul->kode }}</th>
                      <th>{{ $matkul->nama_mata_kuliah }}</th>
                      <th> {{ $matkul->semester }} </th>
                      <th> {{ $matkul->sks }} </th>
                      <th>
                          <button value="{{ $matkul->id }}" id="{{ $loop->index + 1 }}" class="tambah btn btn-success" onclick="tambah(this.id)">
                              Tambah
                          </button> 
                          <input hidden value="{{ $matkul->sks }}" id="sks-{{ $loop->index + 1 }}">
                      </th>
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
  <script src="/js/script.js"></script>
  <script type="text/javascript">
      //untuk inisialisasi localStorage jika kosong
      if(!localStorage['krs']){
        var temp = {list:[],max:10,len:0};
        localStorage['krs'] = JSON.stringify(temp);
      }
      //mencari data dari localStorage
      var krs_cache = JSON.parse(localStorage['krs']).list; 
      var krs_maks = JSON.parse(localStorage['krs']).max;
      var krs_len = JSON.parse(localStorage['krs']).len;

      //untuk mengecek krs yang sudah ada di localStorage
      for(var i=1;i<= {{ count($matkuls) }};i++){
          if(krs_cache.includes(Number($('#'+i).val()))){
            $('#'+i).removeClass( "btn-success" ).addClass('btn-danger').text('Hapus');
          }
      }
      // fungsi untuk mengubah tombol dan menambahkan value ke localStorage
      function tambah(id){
          if($('#'+id).hasClass("btn-success" )){
            if(krs_len == krs_maks){
                alert('tidak bisa');
            }else {
                $('#'+id).removeClass( "btn-success" ).addClass('btn-danger').text('Hapus');
                krs_cache.push(Number($('#'+id).val()));
                krs_len += Number($('#sks-'+id).val());
            }
          }else {
            $('#'+id).removeClass( "btn-danger" ).addClass('btn-success').text('Tambah');
            krs_cache.pop(Number($('#'+id).val()));
            krs_len -= Number($('#sks-'+id).val()); 
          }
          localStorage['krs'] = JSON.stringify({list:krs_cache,max:krs_maks,len:krs_len});
      }
      function hapus(){
          if(typeof localStorage['krs'] !== 'undefined'){
            var list = JSON.parse(localStorage['krs']).list;
            var semester = localStorage['semester'];
            $('#list-krs').attr('value',list.join(','));
            $('#semester-krs').attr('value',semester);
            localStorage.clear();
          }else {
              alert('Data Masih Kosong Silahkan diisi terlebih dahulu !');
          }

      }

  </script>
@endsection