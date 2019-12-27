<?php
namespace AdinanCenci\Climatempo\City;
use AdinanCenci\Climatempo\Climatempo;

class City 
{
    protected $id           = null;
    protected $name         = null;
    protected $state        = null;

    protected $forecast     = null;
    protected $requested    = false;

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
    }

    public function fifteenDays($token) 
    {
        if ($this->requested) {
            return $this->forecast;
        }

        $climatempo             = new Climatempo($token);
        $this->requested        = true;
        return $this->forecast  = $climatempo->fifteenDays($this->id);
    }
    
    public function today($token) 
    {
        return $this->fifteenDays($token)->days[0];
    }

    public function tomorow($token) 
    {
        return $this->fifteenDays($token)->days[1];
    }

    public function afterTomorow($token) 
    {
        return $this->fifteenDays($token)->days[2];
    }

    public function seventyTwoHours($token) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->seventyTwoHours($this->id);
    }

    public function current($token) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->current($this->id);
    }

    public function history($token, $from, $to = null) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->history($this->id, $from, $to);
    }

    public function climateRain($token, $latitude = null, $longitude = null) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->climateRain($this->id, $latitude, $longitude);
    }
}
