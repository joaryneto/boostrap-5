<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerguntasRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perguntas_realizadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pergunta_id')->unsigned();// Id da tabela categories
            $table->foreign('pergunta_id')->references('id')->on('perguntas'); // Define o 
            $table->integer('igreja_classe_id')->unsigned();// Id da tabela categories
            $table->integer('pontos')->unsigned();// Id da tabela categories
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
        Schema::dropIfExists('perguntas_realizadas');
    }
}
