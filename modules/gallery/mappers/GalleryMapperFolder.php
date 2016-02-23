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
		$this->path = $path;
	}

	// ************************************************************************
	// Override functions
	// ************************************************************************
	public function selectAllGalleries(){
		$listGalleries = [];
		$id = 0;
		$scan = preg_grep('#^([^.])#', scandir($this->path));
		foreach($scan as $file){
			if(is_dir($this->path.'/'.$file)){
				$id++;
				$gallery = new \modules\gallery\models\Gallery();
				$gallery->setId($id);
				$gallery->setName($file);
				$listGalleries[] = $gallery;
			}
		}
		return $listGalleries;
	}

	// ************************************************************************
	// Inner functions
	// ************************************************************************
	/**
	 * Scan dir and return an array with all files with specific extension.
	 *
	 * Extensions are given in array parameter. If no parameter given, then
	 * all extension are accepted.
	 * Note that . and .. are not included
	 *
	 * @param array $extensions		Allowed extensions
	 * @return array				Files found
	 */
	private function scanDirWithExt(array $extensions = []){
		global $imgExt;
		$listFiles	= [];
		$scan		= preg_grep("#^[^.]+#", scandir($this->path));
		//Check for each if extension is allowed
		foreach($scan as $file){
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if(in_array(strtolower($ext), $imgExt)){
				$listFiles[] = $file;
			}
		}
		return $listFiles;
	}
}


