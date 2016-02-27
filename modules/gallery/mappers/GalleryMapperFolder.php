<?php
namespace modules\gallery\mappers;

/**
 * Gallery Mapper for Folder Database.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class GalleryMapperFolder implements \modules\gallery\mappers\iGalleryMapper{
	private $path;

	/**
	 * Create a new Folder mapper for Galleries.
	 *
	 * @param string $path Path to data folder (Valided by Factory)
	 */
	public function __construct($path){
		$this->path		= $path;
	}

	// ************************************************************************
	// Override functions
	// ************************************************************************
	public function selectAllGalleries(){
		$listGalleries = [];
		$id = 0;
		//Scan all content except . and ..
		$scan = preg_grep('#^([^.])#', scandir($this->path));
		foreach($scan as $file){
			if(is_dir($this->path.$file)){
				$id++;
				$gallery = new \modules\gallery\models\Gallery();
				$gallery->setId($id);
				$gallery->setName($file);
				$this->loadGalleryImages($gallery);
				$listGalleries[] = $gallery; //Note images are not loaded
			}
		}
		return $listGalleries;
	}

	public function selectGalleryById($id){
		//In case of folder, id is just the position in list (Default sort)
		$currentPos = 0;
		$scan = preg_grep('#^([^.])#', scandir($this->path));
		foreach($scan as $file){
			if(is_dir($this->path.$file)){
				$currentPos++;
				if($currentPos != $id){
					continue; //If is not this id
				}
				$gallery = new \modules\gallery\models\Gallery();
				$gallery->setId($id);
				$gallery->setName($file);
				$this->loadGalleryImages($gallery);
				return $gallery;
			}
		}
		return null; //If we reach here, no gallery for this id
	}


	// ************************************************************************
	// Inner functions
	// ************************************************************************
	/**
	 * Load all images for a gallery. (Gallery mustn't be null)
	 *
	 * @param Gallery $gallery	Gallery to load
	 * @return Boolean			True if successfully loaded, otherwise, False
	 */
	private function loadGalleryImages($gallery){
		global $imgExt;
		$listImgs = [];
		$order = 0;
		//Recever all image (File with extension at the moment)
		$scan = preg_grep("#^([^.]+\.\w+)+#", scandir($this->path.$gallery->getName()));

		//Check for each if extension is allowed
		foreach($scan as $file){
			$info	= pathinfo($file);
			$ext	= $info['extension'];
			$name	= $info['filename'];

			//Check whether extension is acceptable
			if(in_array(strtolower($ext), $imgExt)){
				$order++;
				$img = new \modules\gallery\models\Image();
				$img->setName($name);
				$img->setExtension($ext);
				$img->setGallery($gallery);
				$img->setOrder($order);
				$listImgs[] = $img;
			}
		}
		$gallery->setListImages($listImgs);
		return True;
	}
}


