<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BowUse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bow_uses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->unsignedBigInteger('bows_id');
            $table->foreign('bows_id')->references('id')->on('bows');
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
        Schema::drop('bow_uses');
    }
}
