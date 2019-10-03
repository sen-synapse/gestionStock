<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleAbimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_abimes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idarticle'); 
            $table->integer('iduser'); 
            $table->integer('nbrePiece'); 
            $table->string('couleur'); 
            $table->string('created_at');
            $table->string('updated_at'); 
            //$table->foreign('idarticle')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_abimes');
    }
}
