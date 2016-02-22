<?php
namespace utils\router;

/**
 * Route is a possible URL for a website. It might be used with a router. A
 * Route is set with an URL and a function to execute if route called.
 *
 * @since	Feb 22, 2016
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
	 * @param string $path		Url of this route
	 * @param string $callable	Function to call if route is macht
	 */
	public function __construct($path, $callable){
		$this->path = trim($path, '/'); //We trim all /
		$this->callable = $callable;
	}

	/**
	 * Add a constraint for a parameter
	 *
	 * @param string $param		Param's name to constraint
	 * @param string $regex		Regex to apply
	 * @return Route			Return current Route
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
	 * @param string $url		Url to match
	 * @return Boolean			True if match, otherwise, return false
	 */
	public function match($url){
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
	 *
	 * This method is used in order to mach parameters using 'with'.
	 *
	 * @param Array $match	Match from preg function
	 * @return string		Return a regex catching current param
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
	 * @return mixed Returns the return value of the callback, or FALSE on error.
	 */
	public function call(){
		return call_user_func_array($this->callable, $this->matches);
	}

	/**
	 * Return route URL string filled with parameter given
	 *
	 * @param Array $param		Parameter for this URL
	 * @return string			Return the URL
	 */
	public function getUrl($param){
		$path = $this->path;
		foreach($params as $k => $v){
			$path = str_replace(":$k", $v, $path);
		}
		return $path;
	}
}
