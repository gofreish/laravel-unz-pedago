<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Etudiant;
use App\Models\ECU;

class CreateTestMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_marks', function (Blueprint $table) {
            $table->id();
            $table->double('note', 4, 2);
            $table->boolean('is_normal'); //Si c est pas la session normale c est que c est la session de rattrapage
            $table->string('etudiant_ine');
            $table->foreign('etudiant_ine')->references('ine')->on('etudiants');
            $table->foreignIdFor(ECU::class);
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
        Schema::dropIfExists('test_marks');
    }
}
