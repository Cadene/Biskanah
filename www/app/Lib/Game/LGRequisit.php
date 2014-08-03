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

    public function isAllowed($buildings,$technos,$units)
    {
        $element = $this->node->getElement();
        $lvl = $this->node->getLvl();
        $kind = $element->get('kind');
        $type = $element->get('type');

        if ($kind == 1) {
            $nodes = $buildings;
        }
        else if ($kind == 2) {
            $nodes = $technos;
        } else {
            $nodes = $units;
        }

        if (isset($nodes[$type])) {
            return true;
        }

        $node = current($nodes[$type]);

        if ($lvl == 1)
        {
            $isAllowed = true;
            $missedNodes = [];
            $i = 0;

            foreach ($this->needs as $need)
            {
                if (!$need->isAllowed($buildings,$technos,$units))
                {
                    $isAllowed = false;
                    $missedNodes[$i]['type'] = $need->getElement()->get('type');
                    $missedNodes[$i]['lvl'] = $need->getLvl();
                    $missedNodes[$i]['kind'] = $need->getElement()->get('kind');
                }
            }

            if ($isAllowed) {
                return true;
            } else {
                return $missedNodes;
            }
        }
        else
        {
            // TODO
        }
    }
}