<?php
namespace utils\router;
use \utils\router\Route;

/**
 * Router for URL rewriting with PHP. 
 * Router has an URL (The current asked by user) and routes.
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
	/*
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
	 * @param String $path the url to set for this route
	 * @param String $callable the function to link with this route
	 * @param String $name name for this route (Optional)
	 * @return 
	 */
	public function get($path, $callable, $name = null){
		return $this->addRoute($path, $callable, $name, 'GET');
	}

	/**
	 * Create a new possible path (Using post method)
	 *
	 * @param String $path the url to set for this route
	 * @param String $callable the function to link with this route
	 * @param String $name name for this route (Optional)
	 * @return 
	 */
	public function post($path, $callable, $name = null){
		return $this->addRoute($path, $callable, $name, 'POST');
	}

	/**
	 * Add a route in the router.
	 *
	 * @param String $path the url to set for this route
	 * @param String $callable the function to link with this route
	 * @param String $name name for this route (Optional)
	 * @param String $method method (GET/POST...) for this route
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
	 * @throw RouterException if no route match (Or error)
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
	 * @param String $name URL's name
	 * @param Array $params Params to apply
	 * @return Return the URL
	 * @throws RouteException if named URL doesn't exists
	 */
	public function getNamedUrl($name, $params = []){
		if(!(isset($this->routesNames[$name]))){
			throw new RouteException("No route for this name");
		}
		return $this->routesName[$name]->getUrl($params);
	}
}
