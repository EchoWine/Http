<?php

namespace CoreWine\Http\Test\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	
	protected $fillable = ['name', 'email', ];
}