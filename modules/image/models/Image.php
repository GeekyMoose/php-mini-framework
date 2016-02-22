<?php
namespace modules\image\models;

/**
 * Define a displayable image
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Image extends \modules\core\models\Entity{
	// ************************************************************************
	// Attributes
	// ************************************************************************
	private $name;
	private $path;
	private $description;
	private $dateCreate;
	private $dateUpdate;


	// ************************************************************************
	// Functions
	// ************************************************************************


	// ************************************************************************
	// Attributes
	// ************************************************************************
	public function getName(){
		return $this->name;
	}
	public function getPath(){
		return $this->path;
	}
	public function getDescription(){
		return $this->description;
	}

	public function setName($value){
		$this->name = $value;
		return $this;
	}
	public function setPath($value){
		if(is_string($value)){
			$this->path = $value;
		}
		return $this;
	}
	public function setDescription($value){
		if(is_string($value)){
			$this->description = $value;
		}
		return $this;
	}
}
