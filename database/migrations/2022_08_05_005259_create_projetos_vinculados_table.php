<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjetosVinculadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projetos_vinculados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('projetos_id')->unsigned();// Id da tabela categories
            $table->foreign('projetos_id')->references('id')->on('projetos'); // Define o 
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
        Schema::dropIfExists('projetos_vinculados');
    }
}
