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
        if (isset($this->requisists[$kind])
            && isset($this->requisists[$kind][$id]))
        {
            return $this->requisits[$kind][$id];
        }
        else
        {
            return array();
        }
    }

    public function allowed($nodes='buildings',$buildings,$technos,$units)
    {
        $allowed = array();

        App::uses('LGLoader','Lib/Game');

        $d['Data'.$nodes] = LGLoader::read(ucfirst($nodes));

        foreach ($d['Data'.$nodes] as $datan)
        {
            $id = $datan->get('id');
            $kind = $datan->get('kind');

            $requisit = $this->get($kind,$id);

            if (empty($requisit))
            {
                $allowed[$id] = true;
            }
            else if ($isAllowed = $requisit->isAllowed($buildings,$technos,$units))
            {
                $allowed[$id] = true;
            }
            else
            {
                $missedNodes = $isAllowed;
                $allowed[$id] = $missedNodes;
            }
        }

        return $allowed;
    }


}