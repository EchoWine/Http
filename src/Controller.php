<?php

namespace CoreWine\Http;

use CoreWine\Http\Router;
use CoreWine\View\Engine;
use CoreWine\Http\Exceptions as Exceptions;
use CoreWine\View\Response as ViewResponse;

use CoreWine\Http\Response\JSONResponse;
use CoreWine\Http\Response\RedirectResponse;
use CoreWine\Http\Response\Response;
use CoreWine\Http\Request;

class Controller{
	
	/**
	 * Middleware
	 *
	 * @var Array
	 */
	public $middleware = [];
	
	/**
	 * Define your routes
	 *
	 * @param Router $router
	 */
	public function __routes($router){}

	/**
	 * Boot controller
	 */
	public function __boot(){}
	
	/**
	 * Return a ViewResponse
	 *
	 * @param string $file
	 * @param array $data
	 *
	 * @return ViewResponse
	 */
	public function view($file,$data = []){
		Router::view($data);

		$response = new ViewResponse();
		$response -> setBody(Engine::html($file));
		return $response;
	}

	/**
	 * Returns a new instance of CoreWine\Http\Response\Response
	 *
	 * @return CoreWine\Http\Response\Response 				
	 */
	public function response() {
		return new Response;
	}

	/**
	 * Returns a new instance of CoreWine\Http\Response\RedirectResponse
	 *
	 * @return CoreWine\Http\Response\RedirectResponse 				
	 */
	public function redirect($url){
		return new RedirectResponse(Router::url($url));
	}

	/**
	 * Returns a new instance of CoreWine\Http\Response\JsonResponse
	 *
	 * @return CoreWine\Http\Response\JsonResponse 				
	 */
	public function json($params){
		return (new JSONResponse()) -> setBody($params);
	}

}
?>