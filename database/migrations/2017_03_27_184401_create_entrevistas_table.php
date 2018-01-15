<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntrevistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("id_curriculo")->unsigned();
            $table->string('jaFezEnt')->nullable();
            $table->string('estadoCivil')->nullable();
            $table->string('casProAl')->nullable();
            $table->string('comQMor')->nullable();
            $table->string('temFil')->nullable();
            $table->string('vt')->nullable();
            $table->string('jusCom')->nullable();
            $table->string('jusTrab')->nullable();
            $table->mediumText('moCida')->nullable();
            $table->string('antCrim')->nullable();
            $table->string('vicios')->nullable();
            $table->string('remedio')->nullable();
            $table->string('probSau')->nullable();
            $table->string('parEmpresa')->nullable();
            $table->string('contSup')->nullable();
            $table->string('disHor')->nullable();
            $table->string('sitBco')->nullable();
            $table->string('horExt')->nullable();
            $table->string('ajuLimp')->nullable();
            $table->string('religiao')->nullable();
            $table->string('compFixo')->nullable();
            $table->string('quartel')->nullable();
            $table->string('quartel3')->nullable();
            $table->string('titulo')->nullable();
            $table->string('nocTrabPre')->nullable();
            $table->string('nomConj')->nullable();
            $table->string('escolaridade')->nullable();
            $table->string('sabDom')->nullable();
            $table->string('cartCid')->nullable();
            $table->string('ctps')->nullable();
            $table->string('queCuiFil')->nullable();
            $table->string('pretSal')->nullable();
            $table->string('ulmSal')->nullable();
            $table->string('proEsp')->nullable();
            $table->string('resPeso')->nullable();
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
        Schema::dropIfExists('entrevistas');
    }
}
