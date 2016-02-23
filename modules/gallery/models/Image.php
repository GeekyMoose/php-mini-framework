<?php
namespace modules\gallery\models;

/**
 * Define an Image specific for a Gallery.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Image extends \modules\image\models\Image{
	/** @var int $order Sort order in Gallery */
	private $order;

	/** @var Gallery $gallery Gallery where Image is placed */
	private $gallery;


	// ************************************************************************
	// Getters - Setters
	// ************************************************************************
	public function getOrder(){
		return $this->order;
	}
	public function getGallery(){
		return $this->gallery;
	}

	public function setOrder($value){
		$this->order = $value;
	}
	public function setGallery($value){
		$this->gallery = $value;
	}
}
