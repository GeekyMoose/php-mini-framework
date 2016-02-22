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
	public __construct($path){
		//Must be a directory
		if(!is_dir($path)){
			//@TODO add log
			throw DatabaseException(
				"Unable to create the FolderFactory.
				Path given is not a folder ($path)"
			);
		}
		//Permission required
		if(!is_writable($path) || !is_readable($path){
			//@TODO add log
			throw DatabaseException(
				"Unable to create the FolderFactory for path: $path.
				Write and read write required"
			);
		}
		$this->path = $path;
	}


	// ************************************************************************
	// Mappers' Getters
	// ************************************************************************
	public function getGalleryMapper(){
	}
}
