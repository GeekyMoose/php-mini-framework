<?php
namespace modules\gallery\mappers;

/**
 * Gallery Mapper for Folder Database.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class GalleryMapperFolder extends iGalleryMapper{
	private $path;

	/**
	 * Create a new Folder mapper for Galleries.
	 *
	 * @param string $path Path to data folder (Valided by Factory)
	 */
	public function __constructor($path){
		$this->path = $path;
	}

	public function selectAllGalleries(){
	}
}
