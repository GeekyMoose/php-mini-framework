<?php
namespace modules\gallery\mappers;

/**
 * Define GalleryMappers behaviors
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
interface iGalleryMapper{
	/**
	 * Get all galleries.
	 *
	 * @return array Array of Gallery
	 */
	public function selectAllGalleries();

	//public function selectGalleryById();
}
