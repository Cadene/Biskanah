<?php

App::uses('LGElements','Lib/Game');


class LGBuildings extends LGElements {

    protected $buildings;

    public function __construct($buildings=array())
    {
        foreach ($buildings as $building) {
            $this->add($building);
        }
    }

    public function add($building)
    {
        $this->buildings[$building->get('id')] = $building;

    }

    public function getSize()
    {
        return count($this->buildings);
    }

    public function get($id)
    {
        if (isset($this->buildings[$id])) {
            return $this->buildings[$id];
        } else {
            return array();
        }
    }



}