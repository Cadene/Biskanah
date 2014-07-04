<?php

class Buildings {

    protected $buildings;

    public function __construct($buildings=array())
    {
        $this->buildings = $buildings;
    }

    public function generate($db)
    {
        $table = 'databuildings';

        foreach ($this->buildings as $building)
        {
           $values[] = $building->toValues();
        }

        $db->insertAll($table,Building::getKeys(),$values);
    }

}