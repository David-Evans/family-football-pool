<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
	protected $fillable = [
		'team_name',
		'team_city',
		'team_city_short',
		'nfl_conference',
		'nfl_division',
		'wins',
		'losses'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}
