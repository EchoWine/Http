<?php

namespace CoreWine\Http\Controller;

use CoreWine\Http\Exceptions;
use CoreWine\Http\Request;
use CoreWine\Http\Router as HttpRouter;

class Router{

	public function __construct($controller){
		$this -> controller = $controller;
	}

	public function route($url,$method){
		$controller = $this -> controller;

		if($method !== null){
			return HttpRouter::any() -> callback(function() use($method,$controller){
				if(!method_exists($controller,$method)){
					throw new Exceptions\RouteException("No method $method; Check __routes() definition");
				}

				$request = Request::make();


				return call_user_func_array(array($controller,$method), array_merge([$request],func_get_args()));
			}) -> middleware($controller -> middleware) -> url($url) -> as($url);
		}
	}

	public function any($url,$method){
		return $this -> route($url,$method);
	}

	public function get($url,$method){
		return $this -> route($url,$method) -> get();
	}

	public function post($url,$method){
		return $this -> route($url,$method) -> post();
	}

	public function delete($url,$method){
		return $this -> route($url,$method) -> delete();
	}

	public function put($url,$method){
		return $this -> route($url,$method) -> put();
	}

}