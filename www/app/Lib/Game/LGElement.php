<?php

class LGElement {

    protected $id;
    protected $name;
    protected $desc1;
    protected $desc2;

    protected $res1;
    protected $res2;
    protected $res3;

    public function __construct($id, $name, $desc1, $desc2, $res1, $res2, $res3)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc1 = $desc1;
        $this->desc2 = $desc2;
        $this->res1 = $res1;
        $this->res2 = $res2;
        $this->res3 = $res3;
    }

    public static function getKeys()
    {
        foreach (get_class_vars(get_called_class()) as $key=>$value)
        {
            $rslt[$key] = $key;
        }
        return $rslt;
    }

    public function toValues()
    {
        foreach (self::getKeys() as $key=>$value)
        {
            $rslt[$key] = $this->get($key);
        }
        return $rslt;
    }

    public function toString()
    {
        $string = '';

        foreach ($this->toValues() as $key => $value)
        {
            $string .= $key.' : '.$value."\n";
        }
        return $string;
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