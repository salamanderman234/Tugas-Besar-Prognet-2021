@extends('dashboard-template')

@section('tittle','krs')

@section('content')
{{-- {{ dd($semester) }} --}}
    <div class="row p-3 pt-4 pb-0 mb-0">
      <div class="col-7 pb-0 ps-0 d-flex align-items-end">
        <div class="btn-group border d-flex align-items-center ps-2 border-dark rounded-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill me-2" viewBox="0 0 16 16">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <select name="tahun_ajaran" id="tahun_ajaran" class="form-select rounded-0 ms-0">
              @if (isset($tahun_ajaran_sekarang) && empty($tahun_ajarans->toArray()))
                  <option value="{{ $tahun_ajaran_sekarang['semester'] }}">
                    @if ($tahun_ajaran_sekarang['semester'] % 2 == 0)
                        {{ "Genap - ".strval($tahun_ajaran_sekarang['tahun_ajaran']-1)."/".strval($tahun_ajaran_sekarang['tahun_ajaran']) }}
                    @else
                        {{ "Ganjil  -  ".strval($tahun_ajaran_sekarang['tahun_ajaran'])."/".strval($tahun_ajaran_sekarang["tahun_ajaran"]+1)}}
                    @endif
                  </option>
              @endif
              @foreach ($tahun_ajarans as $tahun_ajaran)
                @if (isset($tahun_ajaran_sekarang)&& $loop->index == 0)
                  <option value="{{ $tahun_ajaran_sekarang['semester'] }}">
                    @if ($tahun_ajaran_sekarang['semester'] % 2 == 0)
                        {{ "Genap - ".strval($tahun_ajaran_sekarang['tahun_ajaran']-1)."/".strval($tahun_ajaran_sekarang['tahun_ajaran']) }}
                    @else
                        {{ "Ganjil  -  ".strval($tahun_ajaran_sekarang['tahun_ajaran'])."/".strval($tahun_ajaran_sekarang["tahun_ajaran"]+1)}}
                    @endif
                  </option>
                @endif
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
              <a id="tambah" role="button" class="btn btn-success px-2" href="{{ route('tambah_krs') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16" style="margin-top: -1px">
                  <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                </svg>
                Tambah</a>
          </div>
        </form>
      </div>
    </div>

    <div class="row p-3 pt-0 mt-2 pb-0">
        <table class="table table-striped" id="table">
            <thead class="bg-primary text-light">
              <tr>
                <th class="text-center" scope="col">No</th>
                <th class="text-center" scope="col">Kode</th>
                <th class="text-center" scope="col">Nama Matakuliah</th>
                <th class="text-center" scope="col">SKS</th>
                <th class="text-center" scope="col">Status</th>
                <th class="text-center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody class="border-0">
            </tbody>
          </table>
    </div>
    <div class="row w-100 d-flex p-0 mx-0" style="font-size: 0.9rem">
      <div class="col-sm-3">
        <strong>SKS Semester Ini</strong>
      </div>
      :
      <div class="col-sm-8">
        <span id="sks">0</span>
      </div>
    </div>
    <div class="row w-100 d-flex p-0 mx-0" style="font-size: 0.9rem">
      <div class="col-sm-3">
        <strong>Maksimal SKS yang Dapat Diambil</strong>
      </div>
      :
      <div class="col-sm-8">
        <span id="maksimal_sks">0</span>
      </div>
    </div>
<script>
  $(document).ready(function(){
      let url = '{{ route("cari_krs",["semester"=> "nilai"])}}';
      tabel_krs(url.replace('nilai',$('#tahun_ajaran').val()),'tbody',true);
      localStorage['semester'] = {{ $semester }};
      localStorage['krs_maks'] = {{ $maksimal_sks }};
      $('#tahun_ajaran').on('change',function(){
        tabel_krs(url.replace('nilai',$('#tahun_ajaran').val()),'tbody',false);
      });
  });
</script>
@endsection

