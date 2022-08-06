<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissaos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();// Id da tabela categories
            $table->integer('projetos_id')->unsigned();// Id da tabela categories
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
        Schema::dropIfExists('permissaos');
    }
}
