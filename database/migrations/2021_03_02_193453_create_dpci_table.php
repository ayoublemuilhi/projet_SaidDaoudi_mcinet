<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dpci', function (Blueprint $table) {
            $table->id();
            $table->string('domaine_fr',200)->unique();
            $table->string('domaine_ar',200)->unique();
            $table->string('type',1);
            $table->unsignedBigInteger('dr_id');
            $table->foreign('dr_id')->references('id')->on('dr');
            $table->softDeletes();
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
        Schema::dropIfExists('dpci');
    }
}
