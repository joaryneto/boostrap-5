<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejasClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igrejas_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('igreja_id')->unsigned();// Id da tabela categories
            $table->foreign('igreja_id')->references('id')->on('igrejas'); // Define o 
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
        Schema::dropIfExists('igrejas_classes');
    }
}
