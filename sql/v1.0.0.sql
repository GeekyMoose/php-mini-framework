/*
	SQL v1.0.0
	Create Database and tables

	Creation:	Feb 22, 2016
	Author:		Constantin MASSON
*/



-- Create database
CREATE DATABASE IF NOT EXISTS `websiteanne` CHARACTER SET 'utf8';
use websiteanne;

-- Create table gallery
CREATE TABLE IF NOT EXISTS `gallery`(
	id				SMALLINT		UNSIGNED NOT NULL,
	name			VARCHAR(50)		NOT NULL,
	description		TEXT,
	date_create		DATETIME		NOT NULL,
	date_update		DATETIME,
	PRIMARY KEY(id)
) ENGINE=INNODB;


-- TABLE link for image in gallery
CREATE TABLE IF NOT EXISTS `rel_image_gallery`(
	id_image		SMALLINT		UNSIGNED NOT NULL,
	id_gallery		SMALLINT		UNSIGNED NOT NULL,
	FOREIGN KEY (id_image)		REFERENCES image(id),
	FOREIGN KEY (id_gallery)	REFERENCES gallery(id)
) ENGINE=INNODB;


-- TABLE image
CREATE TABLE IF NOT EXISTS `image`(
	id				SMALLINT		UNSIGNED NOT NULL AUTO_INCREMENT,
	name			VARCHAR(50)		NOT NULL,
	description		TEXT,
	date_create		DATETIME,
	PRIMARY KEY(id)
) ENGINE=INNODB;
