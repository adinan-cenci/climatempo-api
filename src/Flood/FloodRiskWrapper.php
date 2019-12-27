<?php
namespace AdinanCenci\Climatempo\Flood;
use AdinanCenci\Climatempo\Wrapper;

class FloodRiskWrapper 
{
    protected $slave;

    use Wrapper {
        __get as __parentGet;
    }

    protected static $map = array(
        'valueNow'       => '$this->slave->floodRiskNow->value', 
        'valueNextHour'  => '$this->slave->floodRiskNextHour->value', 
    );

    public function __construct($slave) 
    {
        $this->slave = $slave;
    }

    public function __get($key) 
    {
        switch ($key) {
            case 'now':
                return strtotime($this->slave->floodRiskNow->date);
                break;            
            case 'nextHour':
                return strtotime($this->slave->floodRiskNow->date);
                break;
        }

        return $this->__parentGet($key);
    }
}
