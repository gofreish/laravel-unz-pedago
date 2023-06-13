<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\UE;
use App\Models\User;

class CreateECUSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e_c_u_s', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('nom');
            $table->unsignedSmallInteger('coefficient');
            $table->foreignIdFor(UE::class);
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
        Schema::dropIfExists('e_c_u_s');
    }
}
