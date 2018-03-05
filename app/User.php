<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table = 'user';
    	protected $fillable =
		[
			'id',
			'login',
			'password',
			'name',
			'secound_name',
			'detail',
			'email',
			'budget_history',
			'concept_flag',
			'is_specialist',
			'is_admin'
		];
}
