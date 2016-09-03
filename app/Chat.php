<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
	protected $fillable = [
		'user_id',
		'message'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];
}
