<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'tahun_ajaran',
        'semester',
        'mahasiswa_id',
        'mata_kuliah_id',
        'nilai'

    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class);
    }
    public function matkul(){
        return $this->belongsTo(MataKuliah::class);
    }
    use HasFactory;
}
