<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengembaliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('id_peminjaman');
            $table->date('tgl_diterima');
            $table->boolean('telat')->default('0');
            $table->integer('denda')->nullable();
            $table->boolean('lunas')->default('0')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
           $table->foreign('id_peminjaman')
                ->references('id')
                ->on('peminjamen')
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
        Schema::dropIfExists('pengembalians');
    }
}
