<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Copie;
use App\Models\Salle;

class CreateStudentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('students');
            $table->text('st_absent')->nullable();
            $table->text('surveillants');
            $table->text('su_absent')->nullable();
            $table->integer('taille');
            $table->integer('nbr_copie')->default(0);
            $table->text('commentaire')->nullable();
            $table->foreignIdFor(Salle::class);
            $table->foreignIdFor(Copie::class);
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
        Schema::dropIfExists('student_groups');
    }
}
