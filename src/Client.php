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
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		curl_close($ch);

		return $response;
	}

	/** 
	 * Send a request to retrieve a file
	 *
	 * @param string $url
	 * @param string $destination
	 *
	 */
	public function download($url,$destination){

		# Make dir if doesn't exists
		$dir = dirname($destination);
		
		if(!file_exists($dir))
			mkdir($dir,0777,true);

		$file = fopen($destination, "w");

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER,true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt($ch, CURLOPT_FILE, $file);
		$response = curl_exec($ch);

		if(!$response){
			throw new \Exception(curl_error($ch));
		}

		curl_close($ch);
	}

}