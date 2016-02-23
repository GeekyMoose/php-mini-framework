<?php
namespace modules\gallery\models;

/**
 * Gallery is a set of images.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Gallery extends \modules\core\models\Entity{
	//*************************************************************************
	// Attributes
	//*************************************************************************
	private $name;
	private $description;
	private $dateCreate;
	private $dateUpdate;
	private $listImages;


	//*************************************************************************
	// Constructors - Initialization
	//*************************************************************************


	//*************************************************************************
	// Functions
	//*************************************************************************


	//*************************************************************************
	// Getters - Setters
	//*************************************************************************
	public function getName(){
		return $this->name;
	}
	public function getDescription(){
		return $this->description;
	}
	public function getListImages(){
		return $this->listImages;
	}

	public function setName($name){
		$this->name = $name;
	}
	public function setDescription($description){
		$this->description = $description;
	}
	public function setListImages($listImages){
		$this->listImages = $listImages;
	}
}
