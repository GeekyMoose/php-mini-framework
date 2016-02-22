<?php
namespace modules\gallery\mappers;

/**
 * Mapper for Gallery.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class GalleryMapperPDO implements \modules\gallery\mappers\iGalleryMapper{
	private $pdo;

	/**
	 * Create a PDO mapper for Gallery. (Note argument is valided from Factory)
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
