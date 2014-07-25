<?php

class LGRequisits {

    private $requisits;

    public function __construct($requisits)
    {
        foreach ($requisits as $r)
        {
            $this->add($r);
        }
    }

    public function add($requisit)
    {
        $element = $requisit->getNode()->getElement();
        $id = $element->get('id');
        $kind = $element->get('kind');
        $this->requisits[$kind][$id] = $requisit;
    }

    public function get($kind,$id)
    {
        if (isset($this->requisists[$kind]) && isset($this->requisists[$kind][$id])) {
            return $this->requisits[$kind][$id];
        } else {
            return array();
        }
    }
}