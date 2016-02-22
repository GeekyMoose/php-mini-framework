<?php
namespace modules\gallery\mappers;

/**
 * Mapper for Gallery.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class GalleryMapperPDO{
	private $pdo;

	/**
	 * Create a PDO mapper for Gallery
	 *
	 * @param PDO $pdo DB Connection
	 */
	public function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function selectAllGalleries(){
		$listGalleries = [];
		$request = $this->pdo->query('SELECT * FROM gallery');
		while($data = $request->fetch(\PDO::FETCH_ASSOC)){
			$listGalleries[] = new Gallery($gallery);
		}
		return $listGalleries;
	}
}
