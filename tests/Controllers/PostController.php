<?php

namespace CoreWine\Http\Controllers;

use CoreWine\Http\Psr\Messages\Request;


// let's play with some actual data
// use CoreWine\Http\Test\Models\User;
use CoreWine\Http\Test\Models\Post;

class PostController extends Controller {
	
	// public function __construct() {
		
	// }

	public function index() {
		$posts = Post::all();
		return $posts;
	}

	public function show($id = 1) {
		$posts = Post::where('id', $id) -> get();
		// $posts = Post::where('user_id', 1) -> get();
		return $posts;
	}

	public function update($id = 1, Request $request = null) {
		$post = Post::where('id', '=', $id) -> first();

		// update with the provided parameters

		// @todo return Response
		return $post;
	}
	
}