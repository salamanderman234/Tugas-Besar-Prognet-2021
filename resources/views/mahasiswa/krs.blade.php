@extends('dashboard-template')

@section('tittle','krs')

@section('content')
    <div class="row p-3 pt-4 pb-1">
      <div class="col-7 pb-0 ps-0 d-flex align-items-end">
        <div class="btn-group border d-flex align-items-center ps-2 border-dark rounded-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-fill me-2" viewBox="0 0 16 16">
                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
            <button class="btn btn-sm dropdown-toggle border-start" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Ganjil-2021/2022
            </button>
            <ul class="dropdown-menu">
              ...
            </ul>
        </div>
      </div>
      {{-- jika user belum mengajukan krs maka search akan berganti menjadi ajukan dan tambah mata kuliah --}}
      <div class="col-5 pe-0">
        <form class="mb-3 mb-lg-0 d-flex justify-content-end">
          <input type="search" class="form-control form-control-dark w-75" placeholder="Cari Matakuliah" aria-label="Search" style="max-height: 33px">
        </form>
      </div>
    </div>
    <div class="row p-3 pt-0 mt-2">
        <table class="table table-striped">
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
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@mdo</td>

              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@mdo</td>
                <td>@mdo</td>

              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@twitter</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Larry the Bird</td>
                <td>@mdo</td>
                <td>@mdo</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
    </div>
@endsection
