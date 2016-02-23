<?php
namespace modules\gallery\controllers;

/**
 * Controller for a Gallery.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class GalleryController extends \modules\core\controllers\EntityController{
	/**
	 * Create a new controller for Gallery
	 */
	public function __construct(){
		parent::__construct('gallery');
		global $factory;
		$this->mapper = $factory->getGalleryMapper();
	}


	// ************************************************************************
	// Controller functions
	// ************************************************************************
	public function showGalleries(){
		$listGalleries = $this->mapper->selectAllGalleries();
		$this->setView('listGalleries');
		$this->page->addVar('listGalleries', $listGalleries);
		$this->page->renderPage();
	}

	public function showGalleryById($id){
		$gallery = $this->mapper->selectGalleryById($id);
		if(empty($gallery)){
			$this->page->renderErrorPage("Unknown Gallery");
		}
		$this->setView('displayGallery');
		$this->page->addVar('gallery', $gallery);
		$this->page->renderPage();
	}
}
