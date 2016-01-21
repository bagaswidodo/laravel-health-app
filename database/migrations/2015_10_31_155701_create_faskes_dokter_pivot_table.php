<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaskesDokterPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter_faskes', function (Blueprint $table) {
            $table->integer('dokter_id')->unsigned()->index();
            $table->foreign('dokter_id')->references('dokter_id')->on('dokter')->onDelete('cascade');
            $table->integer('faskes_id')->unsigned()->index();
            $table->foreign('faskes_id')->references('faskes_id')->on('faskes')->onDelete('cascade');
            $table->integer('hari');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->timestamps();
//            $table->primary(['dokter_id', 'faskse_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dokter_faskes');
    }
}
