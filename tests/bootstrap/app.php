<?php

use Illuminate\Database\Capsule\Manager as Capsule;

require __DIR__ . '/../vendor/autoload.php';


/**
 * Debug enable
 */
define('DEBUG', true); // @todo pull out from ini or env file


/**
 * Database setup
 */
$capsule = new Capsule;
$capsule -> addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => 'dummy',
	'username' => 'root',
	'password' => 'secret',
	'charset' => 'utf8',
	'collation' => 'utf8_unicode_ci',
	'prefix' => '',
	]);

$capsule -> setAsGlobal();
$capsule -> bootEloquent();


// @todo pull up environment 

if (DEBUG) {
	// whoops
	$whoops = new \Whoops\Run;
	$whoops -> pushHandler(new \Whoops\Handler\PrettyPageHandler);
	// $whoops -> pushHandler(new \Whoops\Handler\JsonResponseHandler); // api
	// $whoops -> pushHandler(new \Whoops\Handler\PlainTextHandler); // console
	$whoops -> register();
}

$status = 0; // No error

