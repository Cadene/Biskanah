<?php

class LGNode {

    protected $element;

    protected $number;

    public function __construct($element,$number=1)
    {
        $this->element = $element;
        $this->number = $number;
    }

    public function getElement()
    {
        return $this->element;
    }

    public function getLvl()
    {
        return $this->number;
    }

    public function getNum()
    {
        return $this->number;
    }
}