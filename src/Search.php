<?php

namespace Climatempo;

abstract class Search {

	protected static $cities = null;

	public static function find($cityName, $state = null) 
	{
		if($state) {
			return self::searchByState($cityName, $state);
		} else {
			return self::searchByName($cityName);
		}

		return null;
	}


	/**
	 * @return City|null
	 */
	public static function searchById($id) 
	{
		self::loadDataFile();
		
		foreach (self::$cities as $uf => $cities) {
			
			foreach ($cities as $city) {
				if($city['id'] == $id) {
					return self::newCity($city['id'], $city['name'], $uf);
				}
			}

		}
		return null;
	}


	protected static function searchByName($cityName) 
	{	
		self::loadDataFile();

		$results = array();
		foreach (self::$cities as $uf => $cities) {
			
			foreach ($cities as $city) {
				if(self::match($city['name'], $cityName)) {
					$results[] = self::newCity($city['id'], $city['name'], $uf);
				}
			}	
			
		}
		return $results;	
	}

	/**
	 * @param string $cityName
	 * @param string $uf Federative unity, a.k.a. state
	 */
	protected static function searchByState($cityName, $uf) 
	{
		self::loadDataFile();

		if(!isset(self::$cities[$uf])) { return null;}
		
		$results = array();
		foreach (self::$cities[$uf] as $city) {
			if(self::match($city['name'], $cityName)) {
				$results[] = self::newCity($city['id'], $city['name'], $uf);
			}
		}
		return $results;
	}


	protected static function match($cityName, $compare) 
	{
		$cityName = strtolower($cityName);
		$compare = strtolower($compare);
		return substr_count($cityName, $compare);
	}


	protected static function newCity($id, $name, $uf) 
	{
		return new City($id, $name, $uf);
	}

	/**
	 * loads the data file in order to search
	 */
	protected static function loadDataFile() 
	{
		if(!self::$cities) {
			self::$cities = json_decode(file_get_contents(self::dataFile()), true);
		}
	}


	/**
	 * Returns the path to the json containing the cities information
	 */
	protected static function dataFile() 
	{
		return __DIR__.'/cities.json';
	}
}
