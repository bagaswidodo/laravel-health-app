<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaskesPraktekDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('faskes_praktek_dokter', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('user_id')->unsigned();
//            $table->string('review',255);
//            $table->integer('faskes_id')->unsigned();
//            $table->timestamps();
//
//            $table->foreign('user_id')
//                ->references('user_id')
//                ->on('users')
//                ->update('cascade')
//                ->delete('cascade');
//
//            $table->foreign('faskes_id')
//                ->references('faskes_id')
//                ->on('faskes')
//                ->update('cascade')
//                ->delete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('faskes_praktek_dokter');
    }
}
