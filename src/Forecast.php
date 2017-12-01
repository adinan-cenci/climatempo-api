<?php
namespace AdinanCenci\Climatempo;

class Forecast 
{
    protected $slave;

    use Wrapper;

    protected static $map = array(
        'city'              => '$this->slave->name', 
        'dates'             => '$this->slave->data', 
        'days'              => '$this->slave->data', 
    );

    public function __construct($slave, $wrapper) 
    {
        $this->slave = $slave;

        foreach ($slave->data as $key => $date) {
            $slave->data[$key] = new $wrapper($date);
        }
    }
}
