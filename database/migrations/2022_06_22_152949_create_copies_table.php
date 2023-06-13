<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Programme;

/*
    Avant la composition copie = evaluation
*/
class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //On se sert des timestamp pour date de retrait et date de retour
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->string('auteur_sortie')->nullable();
            $table->foreignId('agent_id')->constrained('users')->nullable();
            $table->boolean('is_prepared');//Indique si l evaluation a ete preparer
            $table->boolean('is_normal');
            $table->boolean('is_composer')->default(false);
            $table->boolean('has_note');
            $table->date("date_sortie")->nullable();
            $table->date("date_retour")->nullable();
            $table->foreignIdFor(Programme::class)->unique();
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
        Schema::dropIfExists('copies');
    }
}
