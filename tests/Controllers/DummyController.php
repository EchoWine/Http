<?php

namespace CoreWine\Http\Controllers;


use CoreWine\Http\Psr\Messages\Response;
use CoreWine\Http\Psr\Messages\Request;

// let's play with some actual data
use CoreWine\Http\Test\Models\User;
use CoreWine\Http\Test\Models\Post;

class DummyController extends Controller {
	
	// public function __construct() {
		
	// }

	public function index() {
		$users = User::all();

		return $this -> response($users);
		// return $users;
	}

	public function show() {
		// $user = User::where('id', 2) -> get();
		$posts = Post::where('user_id', 1) -> get();
		return $posts;
	}

	
	
}