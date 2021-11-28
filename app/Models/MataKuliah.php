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
    use HasFactory;
}
