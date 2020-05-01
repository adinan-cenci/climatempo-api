<?php
namespace AdinanCenci\Climatempo;

/**
 * This trait will be used to wrap stdClass objects.
 * The json returned by the API is way too nested, so this trait 
 * will allow us to create shorhands to the properties without 
 * deforming the data.
 */
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
