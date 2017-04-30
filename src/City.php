<?php
namespace Climatempo;

class City 
{
	public $id;
	public $name;
	public $uf;

	protected $forecast = null;

	public function __construct($id, $name, $uf) 
	{
		$this->id 	= $id;
		$this->name = $name;
		$this->uf 	= $uf;
	}

	protected function fetchForecast() 
	{
		if($this->forecast) {return true;}

		$scraper = new Climatempo($this->id);
		$forecast = $scraper->fetch();

		$this->forecast = reset($forecast);
	}

	public function today() 
	{
		$this->fetchForecast();
		return $this->forecast[0];
	}

	public function tomorrow() 
	{
		$this->fetchForecast();
		return $this->forecast[1];
	}

	public function afterTomorrow() 
	{
		$this->fetchForecast();
		return $this->forecast[2];
	}

	public function afterAfterTomorrow() 
	{
		$this->fetchForecast();
		return $this->forecast[3];
	}

	public function getForecast() 
	{
		$this->fetchForecast();
		return $this->forecast;
	}
}