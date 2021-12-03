<?php

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
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

Route::prefix('/{id}')->group(function(){
    Route::get('/',[MahasiswaController::class,'index'])->name('profile');
    Route::post('/ubah',[MahasiswaController::class,'ubah'])->name('ubah');
    Route::get('/matkul',[MataKuliahController::class,'index'])->name('mata_kuliah');
});

Route::get('/test',function() {
    return view('mahasiswa.profile');
});