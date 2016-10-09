<?php

namespace CoreWine\Http;

/**
 * Represents a Client
 */
class Client{

	
	/**
	 * Request
	 *
	 * @var Request
	 */	
	protected $request;


	public function __construct(){

	}

	/**
	 * Send request
	 *
	 * @param string $url
	 * @param string $method
	 * @param array $params
	 *
	 * @return string
	 */
	public function request($url,$method = 'GET',$params = []){

		$ch = curl_init();

		if($method == 'GET' && !empty($params))
			$url .= "?".http_build_query($params);

		curl_setopt($ch, CURLOPT_URL,$url);

		if($method == 'POST'){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		curl_close($ch);

		return $response;
	}

}