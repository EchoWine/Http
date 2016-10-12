<?php

namespace CoreWine\Http\Controllers;

use CoreWine\Http\Psr\Messages\Response;
use CoreWine\Http\Psr\Messages\Request;

use CoreWine\Http\Psr\Messages\Stream;

abstract class Controller {
	
	public function __construct() {
		return true;
	}

	public function response($body = null) {
		$stream = new Stream;
		$stream -> write($body);

		// dd($stream);
		// echo $stream; // testing __toString()
		// dd();

		return new Response($stream);
	}

	// with
	// withError
	// ...
}