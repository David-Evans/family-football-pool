<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiveScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id');
            $table->string('visitor_team',20);
            $table->string('home_team',20);
            $table->integer('visitor_score');
            $table->integer('home_score');
            $table->string('game_status',50);
            $table->datetime('game_date');
            $table->string('winner',20);
            $table->datetime('local_time');
            $table->datetime('last_updated');
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
