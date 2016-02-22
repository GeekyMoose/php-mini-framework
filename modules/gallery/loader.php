<?php
use \modules\gallery\controllers\GalleryController;


/* ****************************************************************************
 * Include all route for gallery
 *
 * Since Feb 22, 2016
 * ****************************************************************************
 */

//Display all galleries
$router->get('/gallery', function(){
	$controller = new GalleryController();
	$controller->showGalleries();
});

//Display one gallery
$router->get('/gallery/:id', function($id){echo "Gallery id: $id";});
