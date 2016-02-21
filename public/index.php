<?php
/*
 * Web site entry gate.
 * Load config etc and start render
 */

require './config.php';

#Import and start Spl autoloader
require '../utils/SplClassLoader.php';

echo "DEBUG URI :". $_SERVER['REQUEST_URI'].'</br>';

#Import utils lib
$utilsLoader = new SplClassLoader('utils', __DIR__.'/..');
$utilsLoader->register();

$router = new utils\router\Router($_GET['url']);

//@TODO Debug version
$router->get('/post', function(){echo "All articles";});
$router->get('/post/:id-:slug/', function($id, $slug){echo "articles toto $id - slug: $slug";})->with("id", "[0-9]+");
$router->get('/post/:id/', function($id){echo "articles $id";});


try{
	$router->run();
} catch (\utils\router\RouterException $ex){
	echo "</br>RouterException:".$ex->getMessage();
}


