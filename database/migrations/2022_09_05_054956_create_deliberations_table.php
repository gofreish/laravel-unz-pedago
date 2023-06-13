<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Promotion;
use App\Models\Cycle;
use App\Models\Semestre;

class CreateDeliberationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliberations', function (Blueprint $table) {
            $table->id();
            $table->date('date_delib');
            $table->boolean('is_normal');//Indique si il s agit d une session normale
            $table->boolean('is_ready');//Indique si le semestre est délibérable
            $table->foreignIdFor(Promotion::class);
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
        Schema::dropIfExists('deliberations');
    }
}
