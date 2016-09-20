<?php

namespace CoreWine\Http\Test\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	
	protected $fillable = ['title', 'body', 'user_id', ];
}