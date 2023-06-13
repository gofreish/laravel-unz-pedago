<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Semestre;
use App\Models\Filiere;
use App\Models\Cycle;

class CreateUES1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_e_s', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nom');
            $table->unsignedSmallInteger('credit');
            $table->foreignIdFor(Filiere::class);
            $table->foreignIdFor(Cycle::class);
            $table->foreignIdFor(Semestre::class);
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
        Schema::dropIfExists('u_e_s');
    }
}
