<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBordereauLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bordereau_livraisons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idclient')->unsigned()->index();
            $table->date('datebrd');
            $table->string('fichier');
            $table->timestamps();
            $table->foreign('idclient')->references('id')->on('clients')->onDelete('cascade'); });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bordereau_livraisons');
    }
}
