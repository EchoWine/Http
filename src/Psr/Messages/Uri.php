<?php

namespace CoreWine\Http\Psr\Messages;


use Psr\Http\Message\UriInterface;


class Uri implements UriInterface {
	protected $_uri;


	public function __construct($uri = null) {
		$this -> _uri = $uri;
		return true;
	}

	public function getScheme() {
		return true;
	}

	public function getAuthority() {
		return true;
	}
	
	public function getUserInfo() {
		return true;
	}

	public function getHost() {
		return true;
	}

	public function getPort() {
		return true;
	}

	public function getPath() {
		return true;
	}

	public function getQuery() {
		return true;
	}

	public function getFragment() {
		return true;
	}

	public function withScheme($scheme) {
		return true;
	}

	public function withUserInfo($user, $password = null) {
		return true;
	}

	public function withHost($host) {
		return true;
	}

	public function withPort($port) {
		return true;
	}

	public function withPath($path) {
		return true;
	}

	public function withQuery($query) {
		return true;
	}

	public function withFragment($fragment) {
		return true;
	}

	public function __toString() {
		if (is_string($this -> _uri)) {
			return $this -> _uri;
		}

		return '';
	}
}