<?php
/*
 * Web site entry gate.
 * Load config etc and start render
 *
 * Since:	Date: Feb 2016
 * Author:	Constantin MASSON
 */
use \utils\database\DAOFactory;
require './config.php';
require '../utils/SplClassLoader.php';

#Import and start autoloader for all elements
$utilsLoader	= new SplClassLoader('utils', __DIR__.'/..');
$utilsLoader	->register();
$modulesLoader	= new SplClassLoader('modules', __DIR__.'/..');
$modulesLoader	->register();

//Create router (To do before modules includes) and set Factory
$router = new utils\router\Router($_GET['url']);

//Scan modules dir and import each leaders
$listFiles = scandir(PATH_MODULES);
foreach($listFiles as $file){
	if(is_file(PATH_MODULES.$file.'/loader.php')){
		require_once PATH_MODULES.$file.'/loader.php';
	}
}

/*
 * Start Router. Check if URL exists. 
 * If exists, display, otherwise, display error route not found.
 * If any other error occure, then error page displayed
 */
try{
	//Set the used factory
	$factory = DAOFactory::getFactory(DAOFactory::FOLDER_DAO);
	$router->run();
}
catch (\utils\router\RouterException $ex){
	if($DEBUG_MODE==TRUE){ echo 'Debug msg: '.$ex->getMessage(); }
	$page = new \modules\core\models\Page();
	$page->renderErrorPage("This URL doesn't exists");
}
catch (\Exception $ex){
	if($DEBUG_MODE==TRUE){ die('Debug message: '.$ex->getMessage()); }
	$page = new \modules\core\models\Page();
	$page->renderErrorPage("An error has occured, sorry");
}


