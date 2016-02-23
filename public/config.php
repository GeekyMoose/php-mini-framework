<?php
/*
 * Web site configurations
 *
 * Since:	Feb 15, 2016
 * Author:	Constantin MASSON
 */
$DEBUG_MODE=TRUE;


# Path configurations
define('PATH_BASE', dirname(__FILE__).'/../'); #We are in public folder, not root
define('PATH_CSS', '');
define('PATH_MODULES', PATH_BASE.'modules/');


// ****************************************************************************
// Config for Folder database
// ****************************************************************************
# Path to data folder, img etc
define('PATH_DATA', '/mnt/diskdata/work/data/wba/');
define('PATH_FOLDER_IMG', '/mnt/diskdata/work/data/wba/imgs/');
$imgExt = array('jpeg', 'jpg', 'png'); //Write only lowercase

// ****************************************************************************
// Config for MySQL Database
// ****************************************************************************
//db configuration
$dbconfig = array(
	'host'		=> '127.0.0.1',
	'user'		=> 'root',
	'pass'		=> 'root',
	'dbname'	=> 'websiteanne',
);
