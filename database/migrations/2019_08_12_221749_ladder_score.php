<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LadderScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ladder_scores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('user_id');
            $table->enum('class', ['Compound', 'Recurve', 'Barebow']);
            $table->enum('target', ['Dutch Target', '40cm', '60cm']);
            $table->integer('score');
            $table->integer('nines');
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ladder_scores');
    }
}
