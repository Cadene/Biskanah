<?php

class LGRequisit {

    protected $node;

    protected $needs;

    public function __construct($node, $needs = array())
    {
        $this->node = $node;
        $this->needs = $needs;
    }

    public function getNode()
    {
        return $this->node;
    }

    public function getNeeds()
    {
        return $this->needs;
    }


}