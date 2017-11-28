<?php
namespace AdinanCenci\Climatempo;

trait Wrapper 
{
    protected $slave;

    public function __get($key) {

        if (isset(self::$map[$key])) {
            $prp = self::$map[$key];
            return eval("return isset($prp) ? $prp : null;");
        }

        if (property_exists($this->slave,  $key)) {
            return $this->slave->{$key};
        }

        return null;
    }
}
