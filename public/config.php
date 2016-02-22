<?php
/*
 * Web site configurations
 *
 * Since:	Feb 15, 2016
 * Author:	Constantin MASSON
 */


# Path configurations
define('PATH_BASE', dirname(__FILE__).'/../'); #We are in public folder, not root
define('PATH_CSS', '');
define('PATH_MODULES', PATH_BASE.'modules/');

# Path to data folder
define('PATH_DATA', '/mnt/diskdata/work/data/wba/');

//db configuration
$dbconfig = array(
	'host'		=> '127.0.0.1',
	'user'		=> 'root',
	'pass'		=> 'root',
	'dbname'	=> 'websiteanne',
);

