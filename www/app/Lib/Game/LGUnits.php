<?php

class LGUnits {

    protected $units;

    protected $kinds;

    protected $databuildings;

    public function __construct($units=array())
    {
        foreach ($units as $u)
        {
            $this->add($u);
        }
    }

    public function add($unit)
    {
        $this->units[$unit->get('id')] = $unit;
        $this->kinds[$unit->get('kind')][] = $unit->get('id');
        $this->databuildings[$unit->get('databuilding_id')][] = $unit->get('id');
    }

    public function get($id)
    {
        if (isset($this->units[$id])) {
            return $this->units[$id];
        } else {
            return array();
        }
    }

    public function getSize()
    {
        return count($this->kinds);
    }

    public function getByKind($kind)
    {
        $units = array();
        foreach ($this->kinds[$kind] as $id)
        {
            $units[$id] = $this->units[$id];
        }
        return $units;
    }

    public function getSizeByKind($kind)
    {
        return count($this->kinds[$kind]);
    }

    public function getByDatabuilding($db_id)
    {
        $units = array();
        foreach ($this->databuildings[$db_id] as $id)
        {
            $units[$id] = $this->units[$id];
        }
        return $units;
    }

    public function getSizeByDatabuilding($db_id)
    {
        return count($this->databuildings[$db_id]);
    }


}