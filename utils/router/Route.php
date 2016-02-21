<?php
namespace utils\router;

/*
 * Route used by Router
 *
 * @see \utils\router\Router.php
 */
class Route{
	// ************************************************************************
	// Attributes
	// ************************************************************************
	private $path;
	private $callable;
	private $matches	= [];
	private $params		= [];

	// ************************************************************************
	// Constructor - Initialization
	// ************************************************************************
	/**
	 * Create a new route with an url and callable function
	 *
	 * @param String $path url of this route
	 * @param String $callable function to call if route is macht
	 */
	public function __construct($path, $callable){
		$this->path = trim($path, '/'); //We trim all /
		$this->callable = $callable;
	}

	/**
	 * Add a constraint for a parameter
	 *
	 * @param String $param Param's name to constraint
	 * @param String $param Regex to apply
	 * @return Return current Route
	 */
	public function with($param, $regex){
		//The regex should have '(' or the mathing will faile.
		$this->params[$param] = str_replace('(', '(?:', $regex);
		return $this;
	}

	// ************************************************************************
	// functions
	// ************************************************************************
	/**
	 * Check if route match the given url.
	 *
	 * @param string $url
	 * @return true if match, otherwise, return false
	 */
	public function match($url){
		echo "</br>URL: $url - PATH: $this->path - ";
		$url = trim($url, '/'); //As we did for path, we trim all /
		//Replace param by a regex (Used later in preg_match)
		$path = preg_replace_callback('#:([\w]+)#', [$this,'paramMatch'], $this->path);
		if(!preg_match("#^$path$#i", $url, $matches)){
			return false;
		}
		array_shift($matches); //Skip first element (The full match url)
		$this->matches = $matches;
		return true;
	}

	/**
	 * Process a macht parameter.
	 * This method is used in order to mach parameters using 'with'
	 *
	 * @param Array $match match from preg function
	 */
	private function paramMatch($match){
		//Remind: match[0] is the param match eltm [1] and [0] is between ()
		if(isset($this->params[$match[1]])){
			return '('.$this->params[$match[1]].')';
		}
		return '([^/]+)';
	}

	/**
	 * Call the callable function for this route
	 *
	 * @return Returns the return value of the callback, or FALSE on error.
	 */
	public function call(){
		return call_user_func_array($this->callable, $this->matches);
	}

	/**
	 * Return route URL String filled with parameter given
	 *
	 * @param Array $param Parameter for this URL
	 * @return String Return the URL
	 */
	public function getUrl($param){
		$path = $this->path;
		foreach($params as $k => $v){
			$path = str_replace(":$k", $v, $path);
		}
		return $path;
	}
}
