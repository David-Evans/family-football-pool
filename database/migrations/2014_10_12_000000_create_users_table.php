<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
// These are legacy
            $table->string('name');
//
            $table->string('email')->unique();
            $table->string('password');

            $table->string('nickname',50);
            $table->string('display_name',50);
            $table->string('sms_number',20);
            $table->string('role');
            $table->string('avatar',100);
            $table->tinyInteger('active')->default(0);
            $table->string('timezone',20);

            $table->rememberToken();
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
        // Schema::drop('users');
    }
}
