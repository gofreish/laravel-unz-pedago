<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;
use App\Models\ECU;

class CreateSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seances', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('hDebut');
            $table->time('hFin');
            $table->text('contenu');
            $table->foreignIdFor(ECU::class);
            $table->foreignId('delegue_id')->constrained('users');
            $table->foreignId('enseignant_id')->constrained('users')->nullable();
            $table->boolean('statut')->default('false')->nullable();
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
        Schema::dropIfExists('seances');
    }
}
