<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vagas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('loja_id')->unsigned();
            $table->integer('cargo_id')->unsigned();
            $table->integer('quantidade');
            $table->string('status');
            $table->string('descricao');
            $table->timestamps();

            $table->foreign('loja_id')->references('id')->on('lojas')->onDelete('cascade');;
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vagas');
    }
}
