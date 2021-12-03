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
            'nama'=>$this->faker->name(),
            'nim'=>$this->faker->unique()->ean8(),
            'alamat'=>$this->faker->sentence(),
            'telepon'=>$this->faker->phoneNumber(),
            'password_mahasiswa' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 
            'program_studi'=>implode("",Arr::random(['Teknologi Informasi', 'Teknik Mesin'],1)),
            'angkatan'=>'2020',
            'foto_mahasiswa'=>'//'
        ];
    }
}
