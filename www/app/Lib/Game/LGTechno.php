<?php

class LGTechno extends LGElement {

    protected $databuilding_id;

    protected $kind = 2;

    public function __construct($id, $name, $desc1, $desc2, $res1, $res2, $res3, $databuilding_id)
    {
        parent::__construct($id,$name,$desc1,$desc2,$res1,$res2,$res3);
        $this->databuilding_id = $databuilding_id;
    }


}