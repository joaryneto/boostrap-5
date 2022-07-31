<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas_grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('perguntas_id')->unsigned();// Id da tabela categories
            $table->foreign('perguntas_id')->references('id')->on('perguntas'); // Define o 
            $table->string('titulo')->nullable();
            $table->string('descricao')->nullable();
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
        Schema::dropIfExists('perguntas_grupos');
    }
}
