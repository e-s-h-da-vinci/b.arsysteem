<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LadderRound extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ladder_rounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('season_id');
            $table->integer('round_nr');
            $table->date('start');
            $table->date('end');
            $table->unique(['season_id', 'round_nr']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ladder_rounds');
    }
}
