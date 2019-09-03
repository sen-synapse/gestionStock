<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLigneVentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idarticle')->unsigned()->index();
            $table->integer('idbrdliv')->unsigned()->index();
            $table->integer('qte');
            $table->timestamps();
            $table->foreign('idarticle')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('idbrdliv')->references('id')->on('bordereau_livraisons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ligne_ventes');
    }
}
