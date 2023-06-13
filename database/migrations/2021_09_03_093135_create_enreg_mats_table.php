<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\TypeEnreg;
use App\Models\Materiel;
use App\Models\User;

class CreateEnregMatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enreg_mats', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedFloat('quantite');
            $table->unsignedFloat('quantite_avant_enreg');
            $table->boolean('achever');
            $table->foreignIdFor(TypeEnreg::class);
            $table->foreignIdFor(Materiel::class);
            $table->foreignIdFor(User::class);
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
        Schema::dropIfExists('enreg_mats');
    }
}
