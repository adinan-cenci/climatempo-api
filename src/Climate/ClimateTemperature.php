<?php
namespace AdinanCenci\Climatempo;

class ClimateTemperature 
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
        'dateBr'         => '???', // need to add support for it
        
        'lastYearMin'    => '$this->slave->data->climate_temperature->last_year->min', 
        'lastYearMax'    => '$this->slave->data->climate_temperature->last_year->max', 

        'normalMin'      => '$this->slave->data->climate_temperature->normal->min', 
        'normalMax'      => '$this->slave->data->climate_temperature->normal->max', 

        'forecastMin'    => '$this->slave->data->climate_temperature->forecast->min',
        'forecastMax'    => '$this->slave->data->climate_temperature->forecast->max',
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
