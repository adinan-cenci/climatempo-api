<?php
namespace AdinanCenci\Climatempo;

class ClimateRain 
{
    protected $slave;

    use Wrapper {
        __get as protected __parentGet;
    }

    protected static $map = array(
        //id
        //name
        //state
        //country
        'date'           => '$this->slave->data->date', 
        'dateBr'         => '$this->slave->data->date_br', 
        'lastYear'       => '$this->slave->data->climate_rain->last_year', 
        'normal'         => '$this->slave->data->climate_rain->normal', 
        'forecast'       => '$this->slave->data->climate_rain->forecast', 
    );

    public function __construct($slave) 
    {
        $this->slave = $slave;
    }

    public function __get($key) 
    {
        if ($key == 'timestamp') {
            return strtotime($this->date);
        }

        return $this->__parentGet($key);
    }
}
