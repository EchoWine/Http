<?php

namespace CoreWine\Http\Psr\Messages;

// use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\Environment;

class Request extends Message implements RequestInterface {
	protected $_target;
	protected $_method;
	protected $_Uri;
	protected $_params = [];


	public function __construct(UriInterface $uri = null) {
		// set specific values
		if (isset($uri) && $uri !== null) {
			$this -> setUri($uri);
		}	
	}

	public function createFromEnvironment($params) {
		// repart values among the properties
		foreach ($params as $param => $value) {
			// $this -> _params[$param] = $value;
			$this -> assign($param, $value);
		}

		return $this;
	}

	/**
	 * Assign the environmental values to the proper members
	 *
	 * @param string $key 			Environmental value key
	 * @param string $value 		Environmental value value
	 * @return boolean 				false if failure
	 */
	public function assign($key, $value) {
		switch ($key) {
			case 'REQUEST_METHOD':
				$this -> setMethod($value);
				break;

			case 'REQUEST_URI':
				$this -> setUri(new Uri($value));
				break;
			
			// @todo remaining cases

			default:
				return false;
				break;
		}

		return true;
	}


	public function getRequestTarget() {
		// retrieve the target
		return "/";
	}

	public function withRequestTarget($target) {
		$clone = clone $this;
		$clone -> setTarget($target);

		return $clone;
	}

	public function setTarget($target) {
		$this -> _target = $target;
	}

	public function getMethod() {
		return $this -> _method;
	}

	public function setMethod($method) {
		$this -> _method = $method;
		// $this -> _params['REQUEST_METHOD'] = $method;
	}

	public function withMethod($method) {
		$clone = clone $this;
		$clone -> setMethod($method);

		return $clone;
	}

	public function getUri() {
		return $this -> _Uri;
		// return $this -> _params['REQUEST_URI'];
	}

	public function setUri(UriInterface $uri) {
		$this -> _Uri = $uri -> __toString();

		// @todo process the $uri 
	}

	public function withUri(UriInterface $uri, $preserveHost = false) {
		$clone = clone $this;
		$clone -> setUri($uri);

		return $clone;
	}
	
}