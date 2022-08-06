<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgrejasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('igrejas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('distrito_id')->unsigned();// Id da tabela categories
            $table->foreign('distrito_id')->references('id')->on('distritos'); // Define o 
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
        Schema::dropIfExists('igrejas');
    }
}
