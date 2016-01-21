<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaskesOpenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faskes_open', function (Blueprint $table) {
            $table->integer('faskes_id')->unsigned();
            $table->integer('hari');
            $table->time('jam_buka');
            $table->time('jam_tutup');
            $table->time('jam_mulai_istirahat')->default('00:00:00');
            $table->time('jam_selesai_istirahat')->default('00:00:00');
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
        Schema::drop('faskes_open');
    }
}
