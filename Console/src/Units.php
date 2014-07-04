<?php

class Units {

    protected $units;

    public function __construct($units=array())
    {
        $this->units = $units;
    }

    public function generate($db)
    {
        $table = 'databuildings';

        foreach ($this->units as $units)
        {
           $values[] = $units->toValues();
        }

        $db->insertAll($table,Unit::getKeys(),$values);
    }

}