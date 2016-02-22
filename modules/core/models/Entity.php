<?php

/**
 * Define an Entity
 *
 * @since	Feb 22, 2016
 * @author	Constantin MASSON
 */
class Entity{
	private $id;

	// ************************************************************************
	// Constructor - Initialization
	// ************************************************************************
	/**
	 * Create a new Entity. If array param is not empty, try to hydrate entity.
	 *
	 * @param Array $data Array of data (Optional)
	 */
	public function __construct(array $data = array()){
		if(!is_null($data)){
			$this->hydrate($data);
		}
	}


	/**
	 * Hydrate Entity
	 * Array given must fit the setters function. 
	 * Hydrate will add 'set' before each key element and try to call the fct 
	 * with 'value' parameter
	 *
	 * @param Array $data Array of data to hydrate
	 */
	public function hydrate(Array $data){
		foreach($data as $key => $value){
			$method = 'set'.ucfirst($key);
			if(is_callable(array($this,$method))){
				$this->$method($value);
			}
		}
	}


	// ************************************************************************
	// Check Functions
	// ************************************************************************
	/**
	 * Check whether this entry is new (New mean id is not set)
	 *
	 * @return Boolean True if new, otherwise, return false
	 */
	public function isNew(){
		return empty($this->id);
	}


	// ************************************************************************
	// Getters - Setters
	// ************************************************************************
	public getId(){
		return $this->id;
	}
	public setId($id){
		$this->id = $id;
	}
}
