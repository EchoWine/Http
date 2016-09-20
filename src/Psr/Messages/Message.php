<?php

namespace CoreWine\Http\Psr\Messages;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;


class Message implements MessageInterface {
	protected $_protocolVersion;
	protected $_headers = []; 
	protected $_body;


	public function getProtocolVersion() {
		return $this -> _protocolVersion;
	}

	public function withProtocolVersion($version) {
		// @todo check $version
		$this -> _protocolVersion = $version;

		return $this;
	}

	public function getHeaders() {
		return $this -> _headers;
	}

	public function hasHeader($name) {
		if (isset($this -> _headers[$name])) {
			return true;
		}

		return false;
	}

	public function getHeader($name) {
		if (isset($this -> _headers[$name])) {
			return $this -> _headers[$name];
		} 

		return [];
	}

	public function getHeaderLine($name) {
		// @tmp
		if (!$this -> hasHeader($name)) {
			return '';
		}

		// @todo use getHeader()
		$result = implode(',', $this -> getHeader($name));
		

		return $result;
	}

	public function withHeader($name, $value) {
		if (!isHeaderValid($name)) {
			throw new \InvalidArgumentException("Invalid header name provided.");	
		}

		if (!isHeaderValid($value)) {
			throw new \InvalidArgumentException("Invalid header value provided.");	
		}

		$this -> setHeader($name, $value); // replace if exists
		return $this;
	}

	public function withAddedHeader($name, $value) {
		if (!isHeaderValid($name)) {
			throw new \InvalidArgumentException("Invalid header name provided.");	
		}

		if (!isHeaderValid($value)) {
			throw new \InvalidArgumentException("Invalid header value provided.");	
		}

		// append only
		if (!$this -> hasHeader($name)) {
			$this -> setHeader($name, $value);
		}
		
		return $this;
	}

	public function isHeaderValid($name) {
		// @tmp
		return true;
	}

	public function setHeader($name, $value) {
		// @todo check values
		$this -> _headers[$name] = $value;
	}

	public function withoutHeader($name) {
		$this -> unsetHeader($name);
		return $this;
	}

	public function unsetHeader($name) {
		unset($this -> _headers[$name]);
	}

	public function getBody() {
		return $this -> _body;
	}

	public function withBody(StreamInterface $body) {
		$clone = $this;
		$clone -> _body = $body;

		return $clone;
	}
}