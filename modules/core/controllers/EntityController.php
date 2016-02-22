<?php
namespace modules\core\controllers;

/**
 * EntityController define general behavior for all controllers. 
 *
 * Controller is always set for a module and control a page to display. Controller 
 * can display a special content by setting 'view' which is a .phtml file which 
 * define page content.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class EntityController{
	// ************************************************************************
	// Attributes
	// ************************************************************************
	/** @var Page $page Page managed by this controller */
	private $page;

	/** @var string $view Name of the view placed in page */
	private $view;

	/** @var string $module Module of this controller */
	private $module;

	/** @var Manager $manager Manager for this Controller */
	private $manager;


	// ************************************************************************
	// Functions
	// ************************************************************************
	/**
	 * Create a new controller for a module.
	 */
	public function __construct($module, $view = null){
		$this->page = new \modules\core\models\Page();
		$this->module = $module;
		if(!is_null($view)){
			$this->setView($view);
		}
	}


	// ************************************************************************
	// Getters - Setters
	// ************************************************************************
	public function setView($view){
		if(is_string($view)){
			$this->view = $view;
			$this->page->setContent(PATH_MODULES."$this->module/views/$view.phtml");
		}
	}
	public function getPage(){
		return $this->page;
	}
}
