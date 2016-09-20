<?php

namespace CoreWine\Http\Psr\Messages;

use Psr\Http\Message\StreamInterface;

/**
 * Represent a message stream
 *
 * @package CoreWine\Http	
 */
class Stream implements StreamInterface {
	protected $_raw;
	protected $_body;

	public function __toString() {
		// @tmp
		return json_encode($this -> _body, JSON_PRETTY_PRINT);
		// return $this -> _body;
		// return 'stream to string';
	}

	public function __set($param, $value) {
		$this -> _body[$param] = $value;
	}

	public function close() {
		return true;
	}

	public function detach() {
		return true;
	}

	public function getSize() {
		return sizeof($this -> _body);
	}

	public function tell() {
		return true;
	}

	public function eof() {
		return true;
	}

	public function isSeekable() {
		return true;
	}

	public function seek($offset, $whence = SEEK_SET) {
		return true;
	}

	public function rewind() {
		return true;
	}

	public function isWritable() {
		return true;
	}

	public function write($string) {
		$this -> _body = $string;
		return sizeof($this -> _body);
	}

	public function isReadable() {
		return true;
	}

	public function read($length) {
		return true;
	}

	public function getContents() {
		return true;
	}

	public function getMetadata($key = null) {
		return true;
	}

}