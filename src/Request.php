<?php

namespace CoreWine\Http;

use CoreWine\Component\Bag;

class Request{

	/**
	 * Force ssl
	 */
	const COOKIE_FORCE_SSL = false;

	/**
	 * HTTP Only
	 */
	const COOKIE_HTTP_ONLY = false;

	/** 
	 * Request method get
	 */
	const METHOD_GET = 'GET';

	/** 
	 * Request method post
	 */
	const METHOD_POST = 'POST';

	/** 
	 * Request method put
	 */
	const METHOD_PUT = 'PUT';

	/** 
	 * Request method delete
	 */
	const METHOD_DELETE = 'DELETE';

	public static $instance;

	/**
	 * Method of request
	 */
	public static $__method;

	public $method;

	/**
	 * Initialization
	 */
	public static function ini(){

		// Prevents javascript XSS attacks aimed to steal the session ID
		ini_set('session.cookie_httponly', 1);

		// Session ID cannot be passed through URLs
		ini_set('session.use_only_cookies', 1);

		// Uses a secure connection (HTTPS) if possible
		// ini_set('session.cookie_secure', 1);

		self::startSession();

		self::$__method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;

	}

	public static function make(){
		$t = new self();
		$t -> retrieve();
		self::$instance = $t;
		return $t;
	}


	/**
	 * Construct
	 */
	public function __construct(){

	}

	public function retrieve(){
		$this -> query = new Bag($_GET);
		$this -> cookie = new Bag($_COOKIE);

		if(Request::getMethod() == 'PUT'){
			parse_str(file_get_contents('php://input'), $put);

			$this -> request = new Bag($put);
		}else{
			$this -> request = new Bag($_POST);
		}

		$this -> server = new Bag($_SERVER);
	}


	public function setMethod($method){
		$this -> method = $method;
	}

	/*
	public function getMethod(){
		return $this -> method;
	}
	*/
	public static function server($index){
		return isset($_SERVER[$index]) ? $_SERVER[$index] : null;
	}

	/**
	 * Get all params in the request
	 */
	public static function getCall(){
		return [
			'url' => Request::getRelativeUrl(),
			'method' => Request::getMethod(),
			'get' => Request::$instance -> get,
			'post' => Request::$instance -> request,
			'put' => Request::$instance -> request,
		];
	}

	public static function post($index){
		return Request::$instance -> request -> get($index);
	}

	public static function get($index){
		return Request::$instance -> get -> get($index);
	}

	public static function put($index){
		return Request::$instance -> request -> get($index);
	}


	/**
	 * Redirect to url
	 *
	 * @param string $url url
	 */
	public static function redirect($url){
		header("Location:".$url);
		die();
	}

	/**
	 * Refresh
	 *
	 * @param string $url url
	 */
	public static function refresh(){
		header("Location:".$_SERVER['REQUEST_URI']);
		die();
	}

	/**
	 * Set a session
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public static function setSession($name,$value){
		$_SESSION[$name] = $value;
	}

	/**
	 * Get $_SESSION
	 *
	 * @param string $name
	 * @return $_SESSION
	 */
	public static function getSession($name){
		return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
	}

	/**
	 * Delete a $_SESSION
	 *
	 * @param string $name
	 */
	public static function unsetSession($name){
		unset($_SESSION[$name]);
	}

	/**
	 * Set a cookie
	 *
	 * @param string $name
	 * @param mixed $value
	 */
	public static function setCookie($name,$value,$expiry = null,$path = '/',$domain = null,$forceSSL = null,$httpOnly = null){

		if(!headers_sent()){

			if($forceSSL == null)
				$forceSSL = self::COOKIE_FORCE_SSL;
			
			if($httpOnly == null)
			   $httpOnly = self::COOKIE_HTTP_ONLY;
			
			if($domain == null)
				$domain = $_SERVER['SERVER_NAME'] == "localhost" ? null : $_SERVER['SERVER_NAME'];
		
			if($expiry == null)
				$expiry = time() + 60*60*24*365*10;

			return setcookie($name, $value, (int)$expiry, $path,null, $forceSSL, $httpOnly);
		}

		return false;	
	}

	/**
	 * Get a cookie
	 *
	 * @param string $name
	 * @return cookie
	 */
	public static function getCookie($name){
		return isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
	}

	/**
	 * Delete a cookie
	 *
	 * @param string $name
	 * @param string $path
	 * @return bool result
	 */
	public static function unsetCookie($name,$path = '/'){
		unset($_COOKIE[$name]);
		return self::setCookie($name,null,-1,$path);
	}

	/**
	 * Start a session
	 */
	public static function startSession(){
		if(session_status() == PHP_SESSION_NONE)
			session_start();
	}
			
	/**
	 * Destroy a session
	 */
	public static function destroySession(){
		session_unset();
		session_destroy();
	}
	
	
	/**
	 * Get relative url
	 * 
	 * @return string relative url
	 */
	public static function getRelativeUrl(){
		return preg_replace("/(\?|&).*/",'',str_replace(dirname($_SERVER['PHP_SELF']),'',$_SERVER['REQUEST_URI']));
	}

	/**
	 * Get relative url
	 * 
	 * @return string relative url
	 */
	public static function getDirUrl(){
		return dirname($_SERVER['PHP_SELF'])."/";
	}

	public static function base(){
		return dirname(self::$instance -> server -> get('PHP_SELF'))."/";
	}
	
	public static function host(){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	    return $protocol.$_SERVER['HTTP_HOST'].'/';
	}
	
	/**
	 * Get method of the request
	 * 
	 * @return string method
	 */
	public static function getMethod(){
		return Request::$__method;
	}

}

?>