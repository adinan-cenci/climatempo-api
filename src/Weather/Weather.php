<?php
namespace AdinanCenci\Climatempo\Weather;
use AdinanCenci\Climatempo\Wrapper;

class Weather 
{
    protected $slave;

    use Wrapper {
        __get as protected __parentGet;
    }

    protected static $map = array(
        'city'              => '$this->slave->name',         
        'date'              => '$this->slave->data->date', 
        'temperature'       => '$this->slave->data->temperature', 
        'windDirection'     => '$this->slave->data->wind_direction', 
        'windVelocity'      => '$this->slave->data->wind_velocity', 
        'humidity'          => '$this->slave->data->humidity', 
        'condition'         => '$this->slave->data->condition', 
        'pressure'          => '$this->slave->data->pressure', 
        'icon'              => '$this->slave->data->icon', 
        'sensation'         => '$this->slave->data->sensation',
    );

    public function __construct($slave) 
    {
        $this->slave = $slave;
    }

    public function __get($key) 
    {
        if ($key == 'dateBr') {
            return date("d/m/Y H:i:s", strtotime($this->date));
        }

        return $this->__parentGet($key);
    }
}
