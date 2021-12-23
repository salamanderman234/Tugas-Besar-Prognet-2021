@extends('admin.dashboard')
@section('tittle','Tambah Transaksi')
@section('content')
<div class="atas data-profile @if(!session()->has('pesan')){{ 'pt-4' }} @endif row h-100 d-flex align-items-center justify-content-center">
    <div class="col-6 mt-3 mb-3 me-3 shadow rounded p-3">
        <form class="row p-0 m-0" action="{{ route('simpan_tambah_transaksi')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="tahun_ajaran">Tahun Ajaran</label>
              <input type="text" value="{{ old('tahun_ajaran') }}" class="form-control rounded-0 @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Tahun Ajaran" name="tahun_ajaran">
              @error('tahun_ajaran')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="semester">Semester</label>
              <input type="text" value="{{ old('semester') }}" class="form-control rounded-0 @error('semester') is-invalid @enderror" id="semester" placeholder="Semester" name="semester">
              @error('semester')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
              <label for="mahasiswa_id">Id Mahasiswa</label>
              <input type="text" value="{{ old('mahasiswa_id') }}" class="form-control rounded-0 @error('mahasiswa_id') is-invalid @enderror" id="mahasiswa_id" placeholder="Id Mahasiswa" name="mahasiswa_id">
              @error('mahasiswa_id')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="form-group">
                <label for="mata_kuliah_id">Id Mata Kuliah</label>
                <input type="text" value="{{ old('mata_kuliah_id') }}" class="form-control rounded-0 @error('mata_kuliah_id') is-invalid @enderror" id="mata_kuliah_id" placeholder="Id Mata Kuliah" name="mata_kuliah_id">
                @error('mata_kuliah_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                  </div>
                @enderror
            </div>
            
            <div class="form-group">
              <label for="nilai">Nilai</label>
              <select class="form-control" name="nilai" id="nilai">
                  @foreach (['Tunda','A','B','C','D','E'] as $nilai)
                      <option value="{{ $nilai }}">{{ $nilai }}</option>
                  @endforeach
              </select>
            </div>

            <div class="form-group mb-4">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status">
                    @foreach (['Belum Disetujui','Disetujui','Dibatalkan'] as $status)
                        <option value="{{ $status }}">{{ $status }}</option>
                    @endforeach
                </select>
              </div>
            <div class="col d-flex justify-content-center p-0 me-1 mb-3">
              <button type="submit" class="simpan btn btn-success py-1 w-25">Tambah</button>
              <a role="button" href="{{ route('daftar_transaksi') }}" class="simpan btn btn-danger py-1 w-25 ms-3">Kembali</a>
            </div>
        </form>
    </div>
</div>   
@endsection