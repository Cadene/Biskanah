<?php

class Techno extends Element {

    protected $id;
    protected $name;
    protected $desc1;
    protected $desc2;

    protected $res1;
    protected $res2;
    protected $res3;

    protected $databuilding_id;

    public function __construct(
        $id, $databuilding_id=1, $name='default',
        $desc1='default',$desc2='default',
        $res1=30, $res2=20, $res3=10
    ){
        $this->id = $id;
        $this->name = $name;
        $this->desc1 = $desc1;
        $this->desc2 = $desc2;
        $this->res1 = $res1;
        $this->res2 = $res2;
        $this->res3 = $res3;
        $this->databuilding_id = $databuilding_id;
    }

    public function set($att,$value)
    {
        $this->$att = $value;
    }

    public function get($att)
    {
        return $this->$att;
    }


}