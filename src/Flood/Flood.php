<?php
namespace AdinanCenci\Climatempo\Flood;
use AdinanCenci\Climatempo\Wrapper;

class Flood 
{
    protected $slave;

    use Wrapper;

    protected static $map = array(
        'city'      => '$this->slave->name', 
        'dates'     => '$this->slave->data', 
        'days'      => '$this->slave->data', 
    );

    /**
     * @param \stdClass $slave
     * @param string $dataWrapper Wrapper class
     */
    public function __construct($slave, $dataWrapper) 
    {
        $this->slave = $slave;

        foreach ($slave->data as $key => $data) {
            $slave->data[$key] = new $dataWrapper($data);
        }
    }
}
