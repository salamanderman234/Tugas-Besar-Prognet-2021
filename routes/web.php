<?php

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MataKuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

//login
Route::get('/login',[LoginController::class,'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class,'login'])->name('post.login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('/mahasiswa')->middleware('auth')->middleware('verifikasi')->group(function () {
    //profile
    Route::get('/',[MahasiswaController::class,'index'])->name('mahasiswa');
    Route::post('/ubah',[MahasiswaController::class,'ubah'])->name('ubah');
    //matkul
    Route::get('/matkul',[MataKuliahController::class,'index'])->name('mata_kuliah');
    Route::get('/matkul/cari',[MataKuliahController::class,'cari'])->name('cari_matkul');
    //krs
    Route::get('/krs',[TransaksiController::class,'index'])->name('krs');
    Route::get('/krs/cari',[TransaksiController::class,'krsMahasiswa'])->name('cari_krs');
    Route::get('/krs/tambah',[TransaksiController::class,'tambahKrs'])->name('tambah_krs');
    Route::post('/krs/simpankrs',[TransaksiController::class,'simpanKrs'])->name('simpan_krs');
    Route::get('/krs/hapus/{id}',[TransaksiController::class,'hapusKrs'])->name('hapus_krs');
    Route::get('/krs/detail/{id}',[TransaksiController::class,'detailKrs'])->name('detail_krs');
    //khs
    Route::get('/khs',[TransaksiController::class,'khs'])->name('khs');
    Route::get('/khs/cari',[TransaksiController::class,'khsMahasiswa'])->name('cari_khs');
});

Route::prefix('/admin')->middleware('auth')->middleware('verifikasi')->group(function () {
    Route::get('/',[AdminController::class,'profile'])->name('admin');
    Route::post('/ubah',[AdminController::class,'ubah'])->name('ubah_admin');

     // mahasiswa
     Route::get('/daftarmahasiswa',[MahasiswaController::class,'semua_mahasiswa'])->name('daftar_mahasiswa');
     Route::get('/daftarmahasiswa/tambah',[MahasiswaController::class,'tambah'])->name('tambah_mahasiswa');
     Route::post('/daftarmahasiswa/tambah/simpan',[MahasiswaController::class,'simpan_tambah'])->name('simpan_tambah_mahasiswa');
     Route::get('/daftarmahasiswa/{id}',[MahasiswaController::class,'edit'])->name('edit_mahasiswa');
     Route::post('/daftarmahasiswa/{id}/simpanedit',[MahasiswaController::class,'simpanedit'])->name('simpan_edit_mahasiswa');
     Route::post('/daftarmahasiswa/{id}/hapus',[MahasiswaController::class,'hapus'])->name('hapus_mahasiswa'); 

    // mata kuliah
    Route::get('/daftarmatkul',[MataKuliahController::class,'semua_matkul'])->name('daftar_matkul');
    Route::get('/daftarmatkul/tambah',[MataKuliahController::class,'tambah'])->name('tambah_matkul');
    Route::post('/daftarmatkul/tambah/simpan',[MataKuliahController::class,'simpan_tambah'])->name('simpan_tambah');
    Route::get('/daftarmatkul/{id}',[MataKuliahController::class,'edit'])->name('edit_matkul');
    Route::post('/daftarmatkul/{id}/simpanedit',[MataKuliahController::class,'simpanedit'])->name('simpan_edit_matkul');
    Route::post('/daftarmatkul/{id}/hapus',[MataKuliahController::class,'hapus'])->name('hapus_matkul'); 
});


