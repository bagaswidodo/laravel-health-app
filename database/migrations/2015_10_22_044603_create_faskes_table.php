<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaskesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faskes', function (Blueprint $table) {
            $table->increments('faskes_id');
            $table->string('nama_faskes',100);
            $table->text('alamat');
            $table->integer('tipe_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->double('latitude',10,8);
            $table->double('longitude',10,6);
            $table->integer('bpjs');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
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
        Schema::drop('faskes');
    }
}
