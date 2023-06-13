<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveillantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveillants', function (Blueprint $table) {
            $table->string('cnib')->unique();
            $table->string('genre');
            $table->string('nom');
            $table->string('prenom');
            $table->integer('non_paye'); //Les surveillance non payés
            $table->integer('total'); //Le nombre total de surveillance
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
        Schema::dropIfExists('surveillants');
    }
}
