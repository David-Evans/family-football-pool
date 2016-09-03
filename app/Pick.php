<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pick extends Model
{
	protected $fillable = [
		'game_id',
		'user_id',
		'pick',
		'game_datetime',
		'visitor_team',
		'home_team'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}
