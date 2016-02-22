<?php
namespace app/debug/Debug;


/**
 * Debug class
 */
class Debug{
	private $path;

	/**
	 * Create a new debugger
	 *
	 * @param String $path path to log files
	 */
	public function __construct($path){
		$this->path = $path;
	}


}
