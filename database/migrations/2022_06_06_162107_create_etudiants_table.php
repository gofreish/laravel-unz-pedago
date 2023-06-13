<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;

class CreateEtudiantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->string('ine')->unique();
            $table->string('genre');
            $table->string('nom');
            $table->string('prenom');
            $table->date('nee_le');
            $table->foreignIdFor(Promotion::class);
            $table->foreignIdFor(Cycle::class);
            $table->string('historique')->nullable(); 
            /* ex: l{1(v:1);2(a:2)...;6(n:1);}|m{1(n:1);...;S4(n:1)}D{1(n:1)}
                l = Licence; m=Master; d=Doctorat;
                v=Validé; a=Ajourné; n=NUll(non évalué ou semestres a venie)
                1(a:2) = semestre 1 ajourné 2 fois
                dans le cas du doctorat :
                1(v:3)=indique que il a effectué 3 années en doctorat 
            */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('etudiants');
    }
}
