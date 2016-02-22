<?php
namespace utils\database;

/**
 * Factory for PDO objects.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class PDOFactory{
	/** @var PDO $pdo Connection Database */
	private $pdo;

	// ************************************************************************
	// Constructor - Loader
	// ************************************************************************
	/**
	 * Create a PDO Factory connected to database.
	 *
	 * @throws DatabaseException if unable to connect
	 */
	public function __construct(){
	}

	/**
	 * Load PDO object for this factory. (Connect with database)
	 *
	 * @throws DatabaseException if unable to connect
	 */
	private function loadPDO(){
		global $dbconfig;
		try{
			$this->pdo = new \PDO(
				'mysql:host='.$dbconfig['host'].';dbname='.$dbconfig['dbname'],
				$dbconfig['user'],
				$dbconfig['pass']
			);
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (Exception $ex){
			//@TODO Create log with message
			throw new DatabaseException("Unable to connect Database");
		}
	}


	// ************************************************************************
	// Manager getters
	// ************************************************************************
	public function getGalleryMapper(){
		return new \modules\gallery\mappers\GalleryMapperPDO($this->pdo);
	}
}
