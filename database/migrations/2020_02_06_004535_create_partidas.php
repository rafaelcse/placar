<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vencedor1_id');
            $table->integer('vencedor2_id')->nullable();
            $table->integer('perdedor1_id');
            $table->integer('perdedor2_id')->nullable();
            $table->double('valor_aposta', 8, 2);
            $table->date('data_partida')
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
        Schema::dropIfExists('partidas');
    }
}
