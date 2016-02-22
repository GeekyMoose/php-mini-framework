<?php
namespace utils\router;
use \utils\router\Route;

/**
 * Router for URL rewriting with PHP.
 * Router is set with an URL, several routes can be added in router (Usually
 * the available website routes).
 *
 * @since	Feb 22, 2016
 */
class Router{
	// ************************************************************************
	// Variables
	// ************************************************************************
	private $url;
	private $routes = [];
	private $routesName = [];


	// ************************************************************************
	// Constructor - Initialization
	// ************************************************************************
	/**
	 * Create a new router with an associated url
	 */
	public function __construct($url){
		$this->url = $url;
	}


	// ************************************************************************
	// functions
	// ************************************************************************
	/**
	 * Create a new possible path (Using get method)
	 *
	 * @param String $path		Url to set for this route
	 * @param String $callable	Function to link with this route
	 * @param String $name		Route name (Optional)
	 * @return Route			Added Route
	 */
	public function get($path, $callable, $name = null){
		return $this->addRoute($path, $callable, $name, 'GET');
	}

	/**
	 * Create a new possible path (Using post method)
	 *
	 * @param String $path		Url to set for this route
	 * @param String $callable	Function to link with this route
	 * @param String $name		Route name (Optional)
	 * @return Route			Added Route
	 */
	public function post($path, $callable, $name = null){
		return $this->addRoute($path, $callable, $name, 'POST');
	}

	/**
	 * Add a route in Router.
	 *
	 * @param String $path		Url to set for this route
	 * @param String $callable	Function to link with this route
	 * @param String $name		Route name (Optional)
	 * @param String $method	Route method (GET/POST...)
	 * @return Route			Added Route
	 */
	private function addRoute($path, $callable, $name, $method){
		$route = new Route($path, $callable);
		$this->routes[$method][] = $route; //$method is used for optimization
		//If route is named, add also in name route
		if(!is_null($name)){
			$this->routesName[$name] = $route;
		}
		return $route;
	}

	/**
	 * Start Router. Check if asked route exists.
	 *
	 * Check for each route if current Router URL is matched by on route. A 
	 * request method must be set (GET/POST..). If no route matches,
	 * and Exception is thrown.
	 *
	 * @return mixe				Return callable function value of matched Route
	 * @throws RouterException	No route match (Or error)
	 */
	public function run(){
		//Request method is required!
		if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
			//@TODO add log: REQUEST_METHOD does not exists
			throw new RouterException("No routes match");
		}
		//Check each route if match asked url
		foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){
			if($route->match($this->url)){
				return $route->call(); //If match, call the route fct
			}
		}
		throw new RouterException('No routes match');
	}

	/**
	 * Get an named URL and fill with params given
	 *
	 * @param String $name		URL's name
	 * @param Array $params		Params to apply
	 * @return string			Return the URL
	 * @throws RouteException	Named URL doesn't exists
	 */
	public function getNamedUrl($name, $params = []){
		if(!(isset($this->routesNames[$name]))){
			throw new RouteException("No route for this name");
		}
		return $this->routesName[$name]->getUrl($params);
	}
}
