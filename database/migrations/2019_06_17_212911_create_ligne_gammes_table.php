<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneGammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_gammes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idgamme')->unsigned()->index();
            $table->integer('idarticle')->unsigned()->index();
            $table->timestamps();

            $table->foreign('idgamme')->references('id')->on('gammes')->onDelete('cascade');
            $table->foreign('idarticle')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_gammes');
    }
}
