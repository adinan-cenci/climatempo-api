<?php
namespace AdinanCenci\Climatempo;

class SeventyTwoHours 
{
    protected $slave;

    use Wrapper;

    protected static $map = array(
        'dateBr'                        => '$this->slave->date_br', 
        
        'precipitation'                 => '$this->slave->rain->precipitation', 

        'windVelocity'                  => '$this->slave->wind->velocity', 
        'gust'                          => '$this->slave->wind->gust', 
        'gustVelocity'                  => '$this->slave->wind->gust', 
        

        'windDegree'                    => '$this->slave->wind->directionDegrees', 
        'windDirectionDegree'           => '$this->slave->wind->directionDegrees', 

        'windDirection'                 => '$this->slave->wind->direction', 

        'temperature'                   => '$this->slave->temperature->temperature', 
    );

    public function __construct($slave) 
    {
        $this->slave = $slave;
    }
}

