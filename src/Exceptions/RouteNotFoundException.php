<?php

namespace CoreWine\Http\Exceptions;

class RouteNotFoundException extends \Exception {
	protected $message = "Invalid route or route not defined.";
}