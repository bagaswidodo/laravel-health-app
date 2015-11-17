<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->increments('dokter_id');
            $table->string('nama',100);
            $table->text('alamat');
            $table->integer('nomor_telpon');
            $table->integer('faskes_id')->unsigned();
            $table->timestamps();

            $table->foreign('faskes_id')
                ->references('faskes_id')
                ->on('faskes')
                ->update('cascade')
                ->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dokter');
    }
}
