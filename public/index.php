<?php


// Front End controller

use CoreWine\Http\Psr\Messages\Request;
use CoreWine\Http\Psr\Messages\Message;
use CoreWine\Http\Psr\Messages\Environment;
use CoreWine\Http\Psr\Messages\Uri;
use CoreWine\Http\Psr\Messages\Stream;

use CoreWine\Http\Router\Router;
use CoreWine\Http\Router\Route;

require __DIR__ . '/../bootstrap/app.php';

// psr

// $message = new Message;
$environment = Environment::init([]);
$request = new Request;
$request -> createFromEnvironment($environment);

// dd($request);


$request2 = $request
	-> withMethod('GET')
	-> withRequestTarget('*')
	-> withUri(new Uri('/posts'));


// dd($request2);
// $url = $request -> getUri();
// dd($url);


$loader = new Twig_Loader_Filesystem(__DIR__ . '/../resources/views');
$twig = new Twig_Environment($loader);
// USE IoC to pass it to as a dependency

// echo $twig -> render('home.twig.html', []);
// exit($status);

// add support for the url /home/index
$router = new Router;

$route = new Route;
$route2 = new Route;
$defaultRoute = new Route;
$route3 = new Route;
$route4 = new Route;



// $route -> setUri($request -> getUri());
// $route -> setUri('/home/index');
// $route -> setMethod(['CoreWine\Http\Controllers\Controller@index']);

// Any invididual route object will be replaced by using $app 
$route -> get('/home/index', 'CoreWine\Http\Controllers\DummyController@index');
$route2 -> get('/home/show', 'CoreWine\Http\Controllers\DummyController@show');
$defaultRoute -> get('/', 'CoreWine\Http\Controllers\DummyController@index');


// Posts
$route3 -> post(
	'/posts/update', 
	'CoreWine\Http\Controllers\PostController@update');

$route4 -> get(
	'/posts', 
	'CoreWine\Http\Controllers\PostController@index');


// dd ($route4 -> getUri());

// $route4 -> get(
// 	'/posts', 
// 	'CoreWine\Http\Controllers\PostController@index');


$router -> add($route);
$router -> add($route2);
$router -> add($route3);
$router -> add($route4);
$router -> add($defaultRoute);



// dd($request -> getUri());
// dd($router);


// resolve the requested Uri
// In production, replace this with a predefined 404 response within a catch()
// $response = new Stream;
// $response = $router -> resolve($request2 -> getUri());
$response = $router -> resolve($request);

echo $response;



