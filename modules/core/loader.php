<?php
/*
 * Include all route for core module
 *
 * Since Feb 22, 2016
 */

// ****************************************************************************
// Routes
// ****************************************************************************

//Home page
$router->get("/", function(){
	$page = new \modules\core\models\Page();
	$page->setContent(PATH_MODULES.'core/views/home.phtml');
	$page->renderPage();
});

//Home page (/ and /index are same)
$router->get("/index", function(){
	$page = new \modules\core\models\Page();
	$page->setContent(PATH_MODULES.'core/views/home.phtml');
	$page->renderPage();
});

