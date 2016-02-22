<?php
namespace modules\gallery\models;

/**
 * Define an Image specific for a Gallery.
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Image extends \modules\image\models\Image{
	/** @var Gallery $gallery Gallery where Image is placed */
	private $gallery;

	/** @var int $order Sort order in Gallery */
	private $order;
}
