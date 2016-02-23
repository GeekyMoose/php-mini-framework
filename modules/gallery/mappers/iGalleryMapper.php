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

	/**
	 * Get a specific gallery using id
	 *
	 * @param int $id	If of gallery to get
	 * @return Gallery	Gallery (Null if no gallery for this id)
	 */
	public function selectGalleryById($id);
}
