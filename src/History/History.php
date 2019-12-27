<?php
namespace AdinanCenci\Climatempo\History;

class History 
{
    protected $slave;

    use Wrapper {
        __get as protected __parentGet;
    }

    protected static $map = array(
        'dateBr'                        => '$this->slave->date_br', 
        'precipitation'                 => '$this->slave->rain->precipitation', 
        'rainInfoSource'                => '$this->slave->rain->source', 

        'minTemperature'                => '$this->slave->temperature->min', 
        'maxTemperature'                => '$this->slave->temperature->max', 
        'minTemp'                       => '$this->slave->temperature->min', 
        'maxTemp'                       => '$this->slave->temperature->max', 
        'tempInfoSource'                => '$this->slave->temperature->source', 
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
