<?php
namespace AdinanCenci\Climatempo;

class City 
{
    protected $id;
    protected $name;
    protected $state;

    protected $forecast     = null;
    protected $requested    = false;

    protected $errors = array();

    public function __construct($id, $name, $state) 
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->state    = $state;
    }

    public function __get($var) 
    {
        $readOnly = array('id', 'name', 'state', 'errors');
        if (in_array($var, $readOnly)) {
            return $this->{$var};
        }

        switch ($var) {
            case 'today':
                return $this->getDay(0);
                break;
            case 'tomorrow':
                return $this->getDay(1);
                break;
            case 'afterTomorrow':
                return $this->getDay(2);
                break;
            case 'afterAfterTomorrow':
                return $this->getDay(3);
                break;

            case 'forecast':
                return $this->getForecast();
                break;
        }
    }

    protected function getDay($key) 
    {
        $this->fetchForecast();
        return isset($this->forecast[$key]) ? $this->forecast[$key] : null;
    }

    protected function getForecast() 
    {
        $this->fetchForecast();
        return $this->forecast;
    }

    protected function fetchForecast() 
    {
        if ($this->requested) { 
            return true;
        }

        $scraper            = new Climatempo($this->id);
        $forecast           = $scraper->fetch();
        $this->errors       = $scraper->errors;
        $this->requested    = true;

        if ($forecast) {
            $this->forecast = reset($forecast);
            return true;
        }

        $this->forecast     = array();
        return false;
    }
}