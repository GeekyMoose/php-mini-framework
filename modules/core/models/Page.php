<?php

namespace modules\core\models;


/**
 * Page define the main render element
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Page{
	// ************************************************************************
	// Attributes
	// ************************************************************************
	private $listVars = [];
	private $content;


	// ************************************************************************
	// Construtorse - Initialization
	// ************************************************************************
	/**
	 * Create a new page. A content can be set in the meantime
	 *
	 * @param String $content Path to the content template
	 */
	public function Page($content = null){
		$this->setContent($content);
	}


	// ************************************************************************
	// Functions
	// ************************************************************************
	/**
	 * Render the page. (Render and exit)
	 */
	public function renderPage(){
		extract($this->listVars);
		ob_start();
		require_once $this->content;
		$content = ob_get_clean();
		require_once PATH_MODULES.'core/views/layout.phtml';
		exit();
	}

	/**
	 * Add a new variable to the page
	 *
	 * @param String $name	Name of the variable
	 * @param Mixe $value	Value of the variable
	 * @return Boolean		True if added, otherwise, return false
	 */
	public function addVar($name, $value){
		if(!is_string($name) || is_numeric($name) || empty($name)){
			return false;
		}
		$this->listVars[$name] = $value;
	}

	// ************************************************************************
	// Getters - Setters
	// ************************************************************************
	/**
	 * Set a new content. If content is null, then current one is deleted
	 *
	 * @param String $content Path to the content template
	 */
	public function setContent($content){
		$this->content = $content;
	}
}
