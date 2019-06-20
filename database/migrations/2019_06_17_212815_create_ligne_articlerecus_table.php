<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneArticlerecusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_articlerecus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idbrdfourniss')->unsigned()->index();
            $table->integer('idarticle')->unsigned()->index();
            $table->integer('iduser')->unsigned()->index();
            $table->bigInteger('quantite');
            $table->string('couleur');
            $table->timestamps();
            $table->foreign('idbrdfourniss')->references('id')->on('bordereau_fournisseurs')->onDelete('cascade');
            $table->foreign('idarticle')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_articlerecus');
    }
}
