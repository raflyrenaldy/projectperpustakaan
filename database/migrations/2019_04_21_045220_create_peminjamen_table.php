<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeminjamenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('id_buku');
            $table->unsignedInteger('id_anggota');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->string('status');
            $table->timestamps();
        $table->foreign('id_anggota')
            ->references('id')
            ->on('anggotas')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjamen');
    }
}
