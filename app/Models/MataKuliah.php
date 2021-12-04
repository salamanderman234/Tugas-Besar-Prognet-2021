<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $fillable = [
        'kode',
        'nama_mata_kuliah',
        'semester',
        'sks',
        'prodi',
        'status_mk'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }

    public static function krsMahasiswa($id){
        return MataKuliah::select('kode','nama_mata_kuliah','sks','status','tahun_ajaran','transaksis.semester')
                ->join('transaksis', 'mata_kuliahs.id', '=', 'transaksis.mata_kuliah_id')
                ->where('transaksis.mahasiswa_id','=',$id)
                ->orderBy('transaksis.semester');
    }
    use HasFactory;
}
