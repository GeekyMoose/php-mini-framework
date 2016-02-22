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

	public function __construct($pdo){
		$this->pdo = $pdo;
	}
}
