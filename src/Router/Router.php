<?php

namespace CoreWine\Http\Router;

use CoreWine\Http\Psr\Messages\Request;

use CoreWine\Http\Exceptions\RouteNotFoundException;

class Router {
	protected $_routes = [];


	public function __construct() {
		return true;
	}

	public function add(Route $route) {
		$this -> _routes[] = $route;
	}

	/**
	 * Call to the route's corresponding controller 
	 *
	 * @param string $uri 		The route URI
	 * @throws \CoreWine\Http\Exceptions\RouteNotFoundException
	 * @return null 				
	 */
	public function resolve(Request $request) {
		foreach ($this -> _routes as $route) {
			if ( 
				($route -> getUri() === $request -> getUri()) && 
				($route -> getMethod() === $request -> getMethod())
				) {
				// match found. Invoke the controller.
					$controller = $route -> getControllerClass();
					$controller = new $controller;
					$method = $route -> getControllerMethod();

					// @todo inject dependencies here
					$response = $controller -> {$method}();

					// echo ($response);
					return $response;
			} 
		}

		// undefined route
		throw new RouteNotFoundException;
	}
}