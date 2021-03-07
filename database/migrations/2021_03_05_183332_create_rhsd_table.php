<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRhsdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rhsd', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qualite_id');
            $table->foreign('qualite_id')->references('id')->on('qualites');

            $table->unsignedBigInteger('domaine_id');
            $table->foreign('domaine_id')->references('id')->on('dpci');

            $table->unsignedBigInteger('axe_id');
            $table->foreign('axe_id')->references('id')->on('axes');

            $table->decimal('AnneeSD',4,0);
            $table->decimal('MoisSD',2,0);
            $table->date('DateSD');
            $table->decimal('ObjectifSD',6,0);
            $table->decimal('RealisationSD',6,0);
            $table->decimal('EcartSD',6,0);
            $table->tinyInteger('EtatSD')->comment('1 => active 0=> inactive');
            $table->tinyInteger('RejetSD')->comment('1 => Rejet 0=> non Rejet');

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
        Schema::dropIfExists('rhsd');
    }
}
