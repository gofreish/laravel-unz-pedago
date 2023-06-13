<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\ECU;
use App\Models\Salle;
use App\Models\TypeProgramme;
use App\Models\Promotion;
use App\Models\User;

class CreateProgrammesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->date('dateDebut');
            $table->date('dateFin')->nullable();
            $table->time('h_Deb_Matin')->nullable();
            $table->time('h_Fin_Matin')->nullable();
            $table->time('h_Deb_Soir')->nullable();
            $table->time('h_Fin_Soir')->nullable();
            $table->text('commentaire')->nullable();
            $table->boolean('public')->default(false);
            $table->foreignIdFor(TypeProgramme::class);
            $table->foreignIdFor(ECU::class)->nullable();
            $table->foreignIdFor(Salle::class)->nullable();
            $table->foreignIdFor(Promotion::class)->nullable();
            $table->foreignIdFor(User::class);
            $table->foreignId('enseignant_id')->constrained('users')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmes');
    }
}
