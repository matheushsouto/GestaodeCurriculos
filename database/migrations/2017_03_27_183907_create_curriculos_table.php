<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurriculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cpf',14)->nullable();
            $table->string('nome');
            $table->tinyInteger('trabSupe');
            $table->date('dat_ficha');
            $table->integer('anos')->nullable();
            $table->string('fone');
            $table->string('foneRec')->nullable();
            $table->date('datNasc');
            $table->string('facebook')->nullable();
            $table->string('rua');
            $table->string('numero')->nullable();
            $table->string('bairro');
            $table->string('sexo')->nullable();;
            $table->string('email')->nullable();;
            $table->string('cidade');
            $table->string('nomeMae')->nullable();
            $table->string('profMae')->nullable();
            $table->string('profPai')->nullable();
            $table->string('nomePai')->nullable();
            $table->string('rg')->nullable();
            $table->string('cnh')->nullable();
            $table->string('numCnh')->nullable();
            $table->string('catCnh')->nullable();
            $table->string('conhecimentos')->nullable();
            $table->string('escolaridade');
            $table->string('cursoSup')->nullable();
            $table->string('cursoSupPer')->nullable();
            $table->string('curTec')->nullable();
            $table->integer('id_user')->unsigned()->nullable();
            $table->string('cargo_id')->nullable();
            $table->string('vaga_id')->nullable();
            $table->string('status')->nullable();
            $table->string('etapa')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->foreign('vaga_id')->references('id')->on('vagas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculos');
    }
}
