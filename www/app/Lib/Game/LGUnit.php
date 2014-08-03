<?php

class LGUnit extends LGElement{

    protected $databuilding_id;

    protected $sort;
    protected $att1;
    protected $att2;
    protected $att3;
    protected $attbat;
    protected $armor;
    protected $spy;
    protected $speed;
    protected $conso;
    protected $capacity;

    protected $kind = 3;

    public function __construct(
        $id, $name, $desc1, $desc2, $res1, $res2, $res3,
        $databuilding_id,
        $sort, $att1, $att2, $att3, $attbat, $armor, $spy, $speed, $conso, $capacity)
    {
        parent::__construct($id,$name,$desc1,$desc2,$res1,$res2,$res3);
        $this->databuilding_id = $databuilding_id;
        $this->sort = $sort;
        $this->att1 = $att1;
        $this->att2 = $att2;
        $this->att3 = $att3;
        $this->attbat = $attbat;
        $this->armor = $armor;
        $this->spy = $spy;
        $this->speed = $speed;
        $this->conso = $conso;
        $this->capacity = $capacity;
    }

}