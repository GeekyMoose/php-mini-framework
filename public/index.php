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
$router  = new utils\router\Router($_GET['url']);
$factory = DAOFactory::getFactory(DAOFactory::PDO_DAO);

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
	$router->run();
} catch (\utils\router\RouterException $ex){
	$page = new \modules\core\models\Page();
	$page->setContent(PATH_MODULES.'core/views/error404.phtml');
	$page->addVar('errorMessage', "Unknown URL");
	$page->renderPage();
} catch (Exception $ex){
	//@TODO Add log with error message (Something went wrong)
	$page = new \modules\core\models\Page();
	$page->setContent(PATH_MODULES.'core/views/error404.phtml');
	$page->addVar('errorMessage', "Sorry, an error has occured");
	$page->renderPage();
}


