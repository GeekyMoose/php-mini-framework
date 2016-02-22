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
	private $path;


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
		global $pathfolder;
		$path = $pathfolder;
		//Must be a directory
		if(!is_dir($path)){
			//@TODO add log
			throw new \utils\database\DatabaseException(
				"Unable to create the FolderFactory.
				Path given is not a folder ($path)"
			);
		}
		$this->path = $path;
	}


	// ************************************************************************
	// Mappers' Getters
	// ************************************************************************
	public function getGalleryMapper(){
		return new \modules\gallery\mappers\GalleryMapperFolder.php($this->path);
	}
}
