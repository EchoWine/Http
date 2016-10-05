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

		if($method == 'GET')
			return file_get_contents($url);

		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);

		if($method == 'POST')
			curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($params));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		print_r($url);
		print_r($method);

		curl_close($ch);

		return $response;
	}

}