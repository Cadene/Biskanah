<?php

App::uses('LGElements','Lib/Game');

class LGTechnos extends LGElements {

    protected $kinds;

    protected $databuildings;

    public function __construct($technos=array())
    {
        foreach ($technos as $t)
        {
            $this->add($t);
        }
    }

    public function add($techno)
    {
        parent::add($techno);
        $this->kinds[$techno->get('kind')][] = $techno->get('id');
        $this->databuildings[$techno->get('databuilding_id')][] = $techno->get('id');
    }

    public function getByKind($kind)
    {
        $units = array();
        foreach ($this->kinds[$kind] as $id)
        {
            $units[$id] = $this->technos[$id];
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