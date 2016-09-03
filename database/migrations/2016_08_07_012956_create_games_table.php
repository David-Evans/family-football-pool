<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('week_id');
            $table->string('day_of_week',10);
            $table->datetime('game_datetime');
            $table->string('visitor_team',20);
            $table->string('home_team',20);
            $table->tinyInteger('locked')->default(0);
            $table->string('winner',20);
            $table->integer('visitor_score');
            $table->integer('home_score');
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
        //
    }
}
