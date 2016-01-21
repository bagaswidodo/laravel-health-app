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
            $table->text('alamat')->nullable();
            $table->integer('nomor_telpon')->nullable();
            $table->integer('faskes_id')->unsigned();
            $table->timestamps();

            $table->foreign('faskes_id')
                ->references('faskes_id')
                ->on('faskes')
                ->onUpdate('cascade')
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
        Schema::drop('dokter');
    }
}
