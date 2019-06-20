<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBordereauFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bordereau_fournisseurs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idfourniss')->unsigned()->index();
            $table->date('datebrd');
            $table->string('fichier');
            $table->timestamps();
            $table->foreign('idfourniss')->references('id')->on('fournisseurs')->onDelete('cascade');});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bordereau_fournisseurs');
    }
}
