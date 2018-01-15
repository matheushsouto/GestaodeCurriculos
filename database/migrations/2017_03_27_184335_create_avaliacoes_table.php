<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvaliacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avaliacoes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_curriculo")->unsigned();
            $table->string('rh_email')->nullable();
            $table->string('rh_mensagem')->nullable();
            $table->string('ger_email')->nullable();
            $table->string('ger_mensagem')->nullable();
            $table->string('res_email')->nullable();
            $table->string('res_mensagem')->nullable();
            $table->string('enc_email')->nullable();
            $table->string('enc_mensagem')->nullable();
            $table->string('resFinal');

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
        Schema::dropIfExists('avaliacoes');
    }
}
