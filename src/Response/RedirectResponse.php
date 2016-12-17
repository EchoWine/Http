<?php

namespace CoreWine\Http\Response;
use CoreWine\Http\Response\Response as Response;

class RedirectResponse extends Response{


	/**
	 * Construct
	 *
	 */
	public function __construct($url){

		parent::__construct();

		$this -> to($url);
	}

	/**
	 * Redirects to the specified URL
	 *
	 * @param string $url
	 *
	 * @return \CoreWine\Http\Response\RedirectResponse 
	 */
	public function to($url, $temporary = false) {
		$this -> header('Location', $url); 

		return $this;
	}

	/**
	 * Redirects back
	 *
	 * @return  \CoreWine\Http\Response\RedirectResponse				
	 */
	public function back() {
		$this -> header('Location', 'javascript://history.go(-1)');

		return $this;
	}




}