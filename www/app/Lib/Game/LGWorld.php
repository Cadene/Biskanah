<?php


class LGWorld {

    // length of a side
    protected $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    public function get($att)
    {
        return $this->$att;
    }
}