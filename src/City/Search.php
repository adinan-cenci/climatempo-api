<?php
namespace AdinanCenci\Climatempo\City;

class Search 
{
    protected static $cities    = null;

    protected $name             = null;

    protected $state            = null;

    protected $ids              = null;

    public function __construct(
        string $name        = null, 
        string $state       = null, 
        $ids                = array()
    ) 
    {
        $this->name         = $name;
        $this->state        = $state;
        $this->ids($ids);
    }

    public function name(string $name) 
    {
        $this->name = $name;
        return $this;
    }

    public function state(string $state) 
    {
        $this->state = strtoupper($state);
        return $this;
    }

    public function ids($ids) 
    {
        if (is_array($ids)) {
            $this->ids = $ids;
        } else {
            $this->ids = func_get_args();
        }
        return $this;   
    }

    public function addId($id) 
    {
        if (is_array($id)) {
            $this->ids = array_merge($this->ids, $id);
        } else {
            $this->ids = array_merge($this->ids, func_get_args());
        }
        return $this;
    }

    public function find() 
    {        
        if ($this->state and $this->name) {
            return $this->searchByState();
        }
        
        if ($this->name or $this->ids) {
            return $this->loopThroughEverything();
        }

        return array();
    }

    protected function loopThroughEverything() 
    {   
        self::loadDataFile();

        $results = array();
        foreach (self::$cities as $state => $cities) {  ;
            $results = array_merge($results, $this->searchArray($cities));
        }

        return $results;    
    }

    protected function searchByState() 
    {
        self::loadDataFile();

        if (! isset(self::$cities[$this->state])) { 
            return array();
        }
        
        return $this->searchArray(self::$cities[$this->state]);
    }

    protected function searchArray(&$cities) 
    {
        $obj = $this;
        $cities = array_filter($cities, function($ar) use ($obj) 
        {
            return $obj->match($ar);
        });

        return $this->instantiate($cities);
    }

    /**
     * Matches a city against the 
     * search parameters
     * @param $city array
     * @return boolean
     */
    protected function match(&$city) 
    {
        if ($this->ids and in_array($city['id'], $this->ids)) {
            return true;
        } 

        if ($this->ids and !in_array($city['id'], $this->ids)) {
            return false;
        }

        if ($this->state and $city['uf'] != $this->state) {
            return false;
        }

        return $this->compareNames($city['name'], $this->name);
    }

    /**
     * Instantiate cities given in an array
     * @param array $cities
     * @return array $array [ City ]
     */
    protected function instantiate($cities) 
    {
        return array_map(function($ar) 
        {
            return new City($ar['id'], $ar['name'], $ar['uf']);
        }, $cities);
    }

    protected function compareNames($compare, $name) 
    {
        return substr_count( 
            strtolower($compare), 
            strtolower($name)
        );
    }

    /**
     * Loads the database in order to realize 
     * searches
     */
    protected static function loadDataFile() 
    {
        if (self::$cities) {
            return;
        }
        
        self::$cities = json_decode(file_get_contents(self::dataFile()), true);
    }
    
    public static function clearCache() 
    {
        self::$cities = array();
    }

    protected static function dataFile() 
    {
        return __DIR__.'/cities.json';
    }
}
