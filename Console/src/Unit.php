<?php

class Unit extends Element{

    protected $id;
    protected $name;
    protected $desc;
    protected $res1;
    protected $res2;
    protected $res3;

    protected $kind;
    protected $att1;
    protected $att2;
    protected $att3;
    protected $attbat;
    protected $armor;
    protected $spy;
    protected $speed;
    protected $conso;
    protected $capacity;

    public function __construct(
        $id, $name='default', $desc='default',
        $res1=30, $res2=20, $res3=10, $kind=1, $att1=100, $att2=100, $att3=100, $attbat=100,
        $armor=100, $spy=0, $speed=6, $conso=1, $capacity=1000
    ) {
        foreach ($this->getKeys() as $key=>$value)
        {
            $this->$key = $$key;
        }
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