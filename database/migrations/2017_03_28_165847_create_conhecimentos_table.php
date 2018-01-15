<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConhecimentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conhecimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_curriculo')->unsigned();
            $table->string('conhecimento');
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
        Schema::dropIfExists('conhecimentos');
    }
}
