<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = [
        'nim',
        'nama',
        'alamat',
        'telepon',
        'program_studi',
        'angkatan',
        'foto_mahasiswa'
    ];

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
    use HasFactory;
}
