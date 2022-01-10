<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama'=>"I Gede Tresna Agung Saputra",
            'nim'=>"admin",
            'alamat'=>"Jalan raya yangbatu",
            'telepon'=>$this->faker->phoneNumber(),
            'password_mahasiswa' => bcrypt("admin"), 
            'program_studi'=>implode("",Arr::random(['Teknologi Informasi', 'Teknik Mesin'],1)),
            'angkatan'=>'2020',
            'foto_mahasiswa'=>'profile-mahasiswa/dup8ld3kTyZOrIXx1ClA0fk7Gg9IL7QLdlDUaZyc.jpg',
            'jabatan'=>'admin'
        ];
    }
}
