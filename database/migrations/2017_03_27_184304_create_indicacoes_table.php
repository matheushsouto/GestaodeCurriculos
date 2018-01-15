<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipInd');
            $table->string('nomInd');
            $table->integer("id_curriculo")->unsigned();
            $table->timestamps();
            $table->foreign('id_curriculo')->references('id')->on('curriculos')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indicacoes');
    }
}
