<?php

namespace CoreWine\Http\Router;

class Route {
	
	protected $_uri;
	protected $_name;
	protected $_method;
	protected $_controller_class;
	protected $_controller_method;
	// ...

	public function setUri($uri) {
		$this -> _uri = $uri;

		return $this;
	}

	public function getUri() {
		return $this -> _uri;
	}

	/**
	 * Defines a route with a GET method request
	 *
	 * @param string $uri 		The request URI
	 * @param string $controller 	The corresponding controller 
	 * @return null 				
	 */
	public function get($uri, $controller) {
		$this -> setController($controller);

		$this -> setUri($uri);
		$this -> setMethod('GET');
	}

	/**
	 * Defines a route with a POST method request
	 *
	 * @param string $uri 		The request URI
	 * @param string $controller 	The corresponding controller 
	 * @return null 				
	 */
	public function post($uri, $controller) {
		$this -> setController($controller);

		$this -> setUri($uri);
		$this -> setMethod('POST');
	}

	/**
	 * Defines a route with a DELETE method request
	 *
	 * @param string $uri 		The request URI
	 * @param string $controller 	The corresponding controller 
	 * @return null 				
	 */
	public function delete($uri, $controller) {
		$this -> setController($controller);

		$this -> setUri($uri);
		$this -> setMethod('DELETE');
	}

	/**
	 * Defines a route with an UPDATE method request
	 *
	 * @param string $uri 		The request URI
	 * @param string $controller 	The corresponding controller 
	 * @return null 				
	 */
	public function update($uri, $controller) {
		$this -> setController($controller);

		$this -> setUri($uri);
		$this -> setMethod('UPDATE');
	}

	/**
	 * Set the route corresponding controller
	 *
	 * @param string $controller 		The controller's name
	 * @throws \CoreWine\Http\Exceptions\InvalidControllerException
	 * @return null 				
	 */
	public function setController($controller) {
		$parts = explode('@', $controller);

		// @todo check before assignment
		$this -> _controller_method = $parts[1];
		$this -> _controller_class = $parts[0];
	}

	public function setMethod($method) {
		$this -> _method = $method;
	}

	public function getMethod() {
		return $this -> _method;
	}

	public function getControllerClass() {
		return $this -> _controller_class;
	}

	public function getControllerMethod() {
		// dd($this -> _controller_method);
		return $this -> _controller_method;
	}

	
}