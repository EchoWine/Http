<?php

namespace CoreWine\Http\Psr\Messages;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;
use CoreWine\Http\Psr\Messages\Stream;

/**
 * Represents a response
 *
 * @package CoreWine\Http	
 */
class Response extends Message implements ResponseInterface {
	protected $_code;
	protected $_reasonPhrase; 


	public function __construct(StreamInterface $body = null) {
		$this -> _body = $body;

		return true;
	}

	public function __toString() {
		// transform the stream to a string
		$body = $this -> getBody() -> __toString();

		return $body;
	}

	// public function toJson(StreamInterface $body = null) {
	// 	$body = json_encode($body, JSON_PRETTY_PRINT);
	// 	return $this -> withBody($body);
	// }

	public function getStatusCode() {
		return $this -> _code;
	}

	public function withStatus($code, $reasonPhrase = '') {
		$clone = clone $this;
		$clone -> _code = $code;
		$clone -> _reasonPhrase = $reasonPhrase;

		return $clone;
	}

	public function getReasonPhrase() {
		return $this -> _reasonPhrase;
	}
}