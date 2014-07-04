<?php

class Techno extends Element {

    protected $id;
    protected $name;
    protected $desc;

    protected $res1;
    protected $res2;
    protected $res3;

    protected $kind;

    public function __construct($id, $kind=1, $name='default', $desc='default', $res1=30, $res2=20, $res3=10)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->res1 = $res1;
        $this->res2 = $res2;
        $this->res3 = $res3;
        $this->kind = $kind;
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