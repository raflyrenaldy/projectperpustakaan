<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanedBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaned_books', function (Blueprint $table) {
            $table->increments('id');
            // $table->unsignedInteger('id_buku');
            $table->unsignedInteger('id_buku');
            $table->unsignedInteger('id_peminjaman');
            $table->string('status');
            $table->timestamps();
            $table->foreign('id_buku')
            ->references('id')
            ->on('bukus')
            ->onDelete('cascade');
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
        Schema::dropIfExists('loaned_books');
    }
}
