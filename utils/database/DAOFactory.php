<?php
namespace utils\database;

/**
 * Define a general factory
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
abstract class DAOFactory{
	const FOLDER_DAO	= '1';
	const PDO_DAO		= '2';

	/**
	 * Get the requested factory.
	 *
	 * Factory to get is determined from given parameter. use constantes from 
	 * DAOFactory to know available factories.
	 *
	 * @param int $type		Define which DAO to instantiate (Use inner Constantes)
	 * @return DAOFactory	Requested Factory
	 */
	public static function getFactory($type){
		switch($type){
			case self::FOLDER_DAO:
				return new FolderFactory();
				break;
			case self::PDO_DAO:
				return new PDOFactory();
				break;
		}
	}


	// ************************************************************************
	// Manager getters
	// ************************************************************************
	/**
	 * Get Mapper for Gallery
	 *
	 * @return GalleryMapper The mapper
	 */
	public abstract function getGalleryMapper();
}
