<?php
namespace AdinanCenci\Climatempo;

class City 
{
    protected $id           = null;
    protected $name         = null;
    protected $state        = null;

    protected $forecast     = null;
    protected $requested    = false;

    protected $errors       = array();

    public function __construct($id, $name, $state) 
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->state    = $state;
    }

    public function __get($var) 
    {
        $readOnly = array('id', 'name', 'state', 'errors');
        if (in_array($var, $readOnly)) {
            return $this->{$var};
        }
    }

    public function fifteenDays($token) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->fifteenDays($this->id);
    }

    public function seventyTwoHours($token) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->seventyTwoHours($this->id);
    }

    public function current($token) 
    {
        $climatempo = new Climatempo($token);
        return $climatempo->current($this->id);
    }
}
