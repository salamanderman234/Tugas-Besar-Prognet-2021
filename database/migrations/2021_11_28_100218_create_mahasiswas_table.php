<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('nim',12);
            $table->string('nama',100);
            $table->string('alamat');
            $table->string('telepon',30);
            $table->enum('program_studi', ['Teknologi Informasi', 'Teknik Mesin']);
            $table->year('angkatan'); //nanti ubah agar tidak nullable
            $table->string('foto_mahasiswa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
}
