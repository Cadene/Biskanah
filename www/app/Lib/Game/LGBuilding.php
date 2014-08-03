<?php

App::uses('LGElement','Lib/Game');


class LGBuilding extends LGElement {

    protected $struct;

    protected $kind = 1;

    public function __construct($id, $name, $desc1, $desc2, $res1, $res2, $res3, $struct)
    {
        parent::__construct($id,$name,$desc1,$desc2,$res1,$res2,$res3);
        $this->struct = $struct;
    }

    public function getProd($lvl = 1)
    {
        if ($this->id == 1)
            $coef = 30;
        else if ($this->id == 2)
            $coef = 20;
        else
            $coef = 10;

        return $coef * $lvl * pow(1.1, $lvl);
    }

    public function getStock($lvl = 1)
    {
        if ($lvl == 0)
            return 100000;
        else
        {
            return 100000 + 50000 * floor(pow(1.6, $lvl));
        }
    }

    public function getTime($lvl, $buildings, $technos)
    {
        // TODO 0.5 peut être trop abusé

        if (isset($buildings[10]))
            $bat10 = current($buildings[10])['lvl'];
        else
            $bat10 = 0;

        if (isset($technos[8]))
            $tech8 = current($technos[8])['lvl'];
        else
            $tech8 = 0;

        $Res = $this->getRes($lvl);

        return ($Res[1] + $Res[2] + $Res[3]) / 5 * (2 / (1 + $bat10)) * pow(0.5, $tech8);
    }

    public function getRes($lvl)
    {
        // Extracteur de métal
        if ($this->id == 1)
        {
            $res[1] = pow(1.5, $lvl-1);
            $res[2] = pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($this->id == 2)
        {
            $res[1] = pow(1.6, $lvl-1);
            $res[2] = pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($this->id == 3)
        {
            $res[1] = pow(1.6, $lvl-1);
            $res[2] = pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else
        {
            $res[1] = pow(2, $lvl-1);
            $res[2] = pow(2, $lvl-1);
            $res[3] = pow(2, $lvl-1);
        }

        $res[1] *= $this->res1;
        $res[2] *= $this->res2;
        $res[3] *= $this->res3;

        return $res;
    }



}