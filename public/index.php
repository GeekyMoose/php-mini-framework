<?php
/*
 * Web site entry gate.
 * Load config etc and start render
 *
 * Creation Date: Feb 2016
 * Author: Constantin MASSON
 */

require './config.php';
require '../utils/SplClassLoader.php';

#Import and start autoloader for all elements
$utilsLoader	= new SplClassLoader('utils', __DIR__.'/..');
$utilsLoader	->register();

$modulesLoader	= new SplClassLoader('modules', __DIR__.'/..');
$modulesLoader	->register();

//Create router (To do before modules includes)
$router = new utils\router\Router($_GET['url']);

//Scan modules dir and import each leaders
$listFiles = scandir(PATH_MODULES);
foreach($listFiles as $file){
	if(is_file(PATH_MODULES.$file.'/loader.php')){
		require_once PATH_MODULES.$file.'/loader.php';
	}
}

//Start!!
try{
	$router->run();
} catch (\utils\router\RouterException $ex){
	$page = new \modules\core\models\Page();
	$page->setContent(PATH_MODULES.'core/views/error404.phtml');
	$page->renderPage();
	//echo "error";
}


