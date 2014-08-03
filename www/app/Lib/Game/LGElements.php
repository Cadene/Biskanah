<?php

class LGElements implements Iterator {

    protected $position;

    protected $elements;

    public function __construct($elements=array())
    {
        $this->position = 1;

        foreach ($elements as $element)
        {
            $this->add($element);
        }
    }

    public function add($element)
    {
        $this->elements[$element->get('id')] = $element;
    }

    public function getSize()
    {
        return count($this->elements);
    }

    public function get($id)
    {
        if (isset($this->elements[$id]))
        {
            return $this->elements[$id];
        }
        else
        {
            return array();
        }
    }

    function rewind()
    {
        $this->position = 1;
    }

    function current()
    {
        return $this->elements[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->elements[$this->position]);
    }
}