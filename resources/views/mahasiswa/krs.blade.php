@extends('dashboard-template')

@section('tittle','krs')

@section('content')
{{-- {{ dd($tahun_ajaran_sekarang) }} --}}
    <div class="row p-3 pt-4 pb-1">
      <div class="col-7 pb-0 ps-0 d-flex align-items-end">
        <div class="btn-group border d-flex align-items-center ps-2 border-dark rounded-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill me-2" viewBox="0 0 16 16">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <select name="tahun_ajaran" id="tahun_ajaran" class="form-select rounded-0 ms-0">
              @if (!is_null($tahun_ajaran_sekarang))
                <option value="{{ $tahun_ajaran_sekarang['value'] }}">
                    @if ($tahun_ajaran_sekarang=='Genap')
                      {{ $tahun_ajaran_sekarang['semester'].' - '.((string)((int)($tahun_ajaran_sekarang['tahun_ajaran'])-1))}}
                    @else
                      {{ $tahun_ajaran_sekarang['semester'].'  -  '.$tahun_ajaran_sekarang['tahun_ajaran'] }}
                    @endif
                </option>
              @endif
              @foreach ($tahun_ajarans as $tahun_ajaran)
                <option value="{{ $tahun_ajaran->semester }}">
                  @if ($tahun_ajaran->semester % 2 == 0)
                      {{ "Genap - ".strval($tahun_ajaran->tahun_ajaran-1)."/".strval($tahun_ajaran->tahun_ajaran) }}
                  @else
                      {{ "Ganjil  -  ".strval($tahun_ajaran->tahun_ajaran)."/".strval($tahun_ajaran->tahun_ajaran+1)}}
                  @endif
                </option>
              @endforeach
            </select>
        </div>
      </div>
      {{-- jika user belum mengajukan krs maka search akan berganti menjadi ajukan dan tambah mata kuliah --}}
      <div class="col-5 pe-0">
        <form class="mb-3 mb-lg-0 d-flex justify-content-end">
          <div class="btn-group d-flex align-items-center p-0 rounded-3">
              <a role="button" class="btn btn-success px-2 ps-1" href=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
              </svg>Tambah</a>
          </div>
        </form>
      </div>
    </div>
    <div class="row p-3 pt-0 mt-2">
        <table class="table table-striped" id="table">
            <thead class="bg-primary">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama Matakuliah</th>
                <th scope="col">SKS</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody class="border-0">
            </tbody>
          </table>
    </div>
<script src="js/jquery-3.6.0.min.js"></script>
<script>
  tabel_krs();
  $(document).ready(function(){
      $('#tahun_ajaran').on('change',function(){
        $('tbody').empty()
        tabel_krs();
      });
  });

  function tabel_krs(){
    var url_ajax = '{{ route('cari_krs',['semester'=> "nilai"])}}';
    url_ajax = url_ajax.replace('nilai',$('#tahun_ajaran').val());
    $.ajax({
      type:"GET",
      url: url_ajax,
      dataType: "json",
      success: function(response){
        // console.log(response.krs);
        if(response.krs.length > 0){
          $.each(response.krs, function(key, item){
            var button = "";
            if(item.status == "Disetujui"){
              button = '<a role="button" class="btn btn-primary px-2" href="'+'//'+'">\
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square me-2" viewBox="0 0 16 16">\
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
                </svg>\
                List Mahasiswa\
                </a>';
            }else {
              button = '<a role="button" class="btn btn-danger px-4" href="'+'//'+'">\
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">\
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>\
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>\
                </svg>\
                Hapus\
                </a>';
            }
            $('tbody').append(
              '<tr>\
                <th scope="row">'+ (key+1) +'</th>\
                <td>'+item.kode+'</td>\
                <td>'+item.nama_mata_kuliah+'</td>\
                <td>'+item.sks+'</td>\
                <td>'+item.status+'</td>\
                <td>'+button+'</td>\
              </tr>'

            );
          });
        }else {
          $('tbody').append(
              '<tr>\
                <td colspan="6" align="center"> Kamu Belum Mengambil KRS di Semester Ini ! </td>\
              </tr>'

          );
        }
        
      }
    });
  } 
 

</script>
@endsection

