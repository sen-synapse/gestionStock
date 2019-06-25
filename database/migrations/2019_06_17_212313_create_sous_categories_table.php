<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSousCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sous_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codesouscat');
            $table->string('souscategorie');
            $table->integer('idcategorie')->unsigned()->index();
            $table->timestamps();
            $table->foreign('idcategorie')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sous_categories');
    }
}
