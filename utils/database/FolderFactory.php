<?php
namespace utils\database;

/**
 * Foctory for 'Folder based' data. 
 *
 * Using this factory, data will provide from physical folders.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class FolderFactory extends \utils\database\DAOFactory{
	/** @var string $path Path to the data folder root */
	private $paths = [];


	// ************************************************************************
	// Constructor - Loader
	// ************************************************************************
	/**
	 * Create a new FolderFactory.
	 *
	 * FolderFactory manage the folders unders given path. An Exception is thrown
	 * if path doesn't exists.
	 *
	 * @param string $path		Path to folder data
	 * @throws DatabaseException if unable to connect
	 */
	public function __construct(){
		//Set each path (General path, imgs path)
		$this->paths['imgs']	= PATH_IMG;
		$this->paths['gallery']	= PATH_GALLERY;

		//If not valid data base (Folder)
		if(!$this->isValidDataFolder()){
			//@TODO add log
			ob_start();
			echo '<pre>dirname: '.dirname(__FILE__);
			var_dump($this->paths);
			echo '</pre>';
			$vard = ob_get_clean();
			throw new \utils\database\DatabaseException(
				"Unable to create the FolderFactory. Path given is not valid.
				Check the path value in config.php.
				Usually, data folder must have several specific subfolders."
				.$vard
			);
		}
	}

	/**
	 * Check whether the given path is a falid data folder.
	 *
	 * Data folder must, exists First, but must follow a specific architecture.
	 * For example, data folder can be made of several spec subfolder like 
	 * /images/ /texts/ etc..
	 * Note: path is recovered from config (No parameters)
	 *
	 * @return Boolean True if valid, otherwise, return false
	 */
	private function isValidDataFolder(){
		foreach($this->paths as $folder){
			if(!is_dir($folder)){
				return False;
			}
		}
		return True;
	}


	// ************************************************************************
	// Mappers' Getters
	// ************************************************************************
	public function getGalleryMapper(){
		return new \modules\gallery\mappers\GalleryMapperFolder($this->paths['gallery']);
	}
}
