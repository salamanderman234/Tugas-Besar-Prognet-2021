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
});

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('post.login');

Route::prefix('/profile')->group(function () {
    Route::get('/',[MahasiswaController::class,'index'])->name('profile');
    Route::post('/ubah',[MahasiswaController::class,'ubah'])->name('ubah');
});

Route::prefix('/matkul')->group(function () {
    Route::get('/',[MataKuliahController::class,'index'])->name('mata_kuliah');
    Route::get('/cari',[MataKuliahController::class,'cari'])->name('cari_matkul');
});

Route::prefix('/krs')->group(function () {
    Route::get('/',[TransaksiController::class,'index'])->name('krs');
    Route::get('/cari',[TransaksiController::class,'krsMahasiswa'])->name('cari_krs');
    Route::get('/tambah',[TransaksiController::class,'tambahKrs'])->name('tambah_krs');
    Route::post('/simpankrs',[TransaksiController::class,'simpanKrs'])->name('simpan_krs');
});




Route::get('/admin',[AdminController::class,'profile'])->name('admin');
Route::post('/adminubah',[AdminController::class,'ubah'])->name('ubah_admin');
Route::get('/daftarmatkul',[MataKuliahController::class,'semua_matkul'])->name('daftar_matkul');
Route::get('/tambahmatkul',[MataKuliahController::class,'tambah'])->name('tambah_matkul');
Route::post('/simpantambah',[MataKuliahController::class,'simpan_tambah'])->name('simpan_tambah');
Route::post('/daftarmatkul/{id}/hapus',[MataKuliahController::class,'hapus'])->name('hapus_matkul');
Route::get('/daftarmatkul/{id}',[MataKuliahController::class,'edit'])->name('edit_matkul');
Route::post('/daftarmatkul/{id}/simpanedit',[MataKuliahController::class,'simpanedit'])->name('simpan_edit_matkul'); 

// Route::post('/daftarmatkul/{id}/hapus',[MataKuliahController::class,'hapus'])->name('hapus_matkul');


Route::get('/test',function() {
    return view('mahasiswa.profile');
});