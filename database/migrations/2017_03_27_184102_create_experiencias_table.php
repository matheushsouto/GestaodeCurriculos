<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiencias', function (Blueprint $table) {
            $table->increments('id');
            $table->string("empresa");
            $table->string("funcao");
            $table->string("entSai");
            $table->string("motSai");
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
        Schema::dropIfExists('experiencias');
    }
}
