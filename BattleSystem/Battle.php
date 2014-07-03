<?php


class Battle {

	private $offUnits;
	private $defUnits;

	private $size;

    private $strategy;

	public function __construct(UnitArray $offUnitArray, UnitArray $defUnitArray, Strategy $strategy)
	{
		if (($size=$defUnitArray->size()) != ($s2=$offUnitArray->size()))
			throw new Exception('Size incorrect : '.$size.' != '.$s2);

		$this->size = $size;
        $this->offUnits = $offUnitArray;
        $this->defUnits = $defUnitArray;
        $this->strategy = $strategy;
    }

	public function size()
	{
		return $this->size;
	}

	public function fight()
	{
        $this->echoIntro();

		$offPoints = $this->fireOn('def');
		$defPoints = $this->fireOn('off');

        if ($offPoints > $defPoints)
        {
            $winner = 'off';
            $winnerPts = $offPoints;
            $loserPts = $defPoints;
            $winnerUnits = $this->offUnits;
            $loserUnits = $this->defUnits;
        }
        else
        {
            $winner = 'def';
            $winnerPts = $defPoints;
            $loserPts = $offPoints;
            $winnerUnits = $this->defUnits;
            $loserUnits = $this->offUnits;
        }

		// we compute the initial loses
		$winLosesPc = pow($loserPts / $winnerPts, 1.1) /2 * 100;
		$losLosesPc = 100 - $winLosesPc;

        debug($winLosesPc, 'winLosesPc');
        debug($losLosesPc, "losLosesPc");

        // TODO we apply the strategy
        //$winnerLosesPc *= $this->strategy->getLosesPc() / 100;
        //$loserLosesPc *= $this->strategy->getLosesPc() / 100;


        debug($winLoses = $this->computeLoses($winLosesPc, $winnerUnits), "winLoses");
        debug($losLoses = $this->computeLoses($losLosesPc, $loserUnits), "losLoses");

        $winUnitNb = $this->applyLoses($winnerUnits, $winLoses);
        $losUnitNb = $this->applyLoses($loserUnits, $losLoses);

        /*debug($offPoints);
        debug($defPoints);
    */


        debug($winner);
        debug($winUnitNb, 'winUnitNb');
        debug($losUnitNb);
	}

    /**
     * @param $unitsPc
     * @param $unitArray
     *
     * @return array
     */
    private function computeLoses($losesPc, $unitArray)
    {
        $loses = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            // ex: 26.769911504425
            $initial = $unitArray->get('unitsNb')[$i] * $losesPc/100;
            // ex: 26
            $loses[$i] = floor($initial);
            // ex: 76%
            $pc = floor(($initial - $loses[$i]) * 100);

            if (rand(0,100) <= $pc)
                $loses[$i] += 1;
        }
        return $loses;
    }

    /**
     * @param $unitArray
     * @param $loses
     *
     * @return array
     */
    private function applyLoses($unitArray, $loses)
    {
        $unitsNb = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $unitsNb[$i] = $unitArray->get('unitsNb')[$i] - $loses[$i];
        }
        return $unitsNb;
    }



    // TODO
    private function stratOnLoses($strat, $losesPc)
    {
        $nLosesPc = $strat->getLosesPc * $losesPc;

    }

    private function echoIntro()
    {
        $string = "\n/////// BATTLE ///////\n\n";
        $string .= "Type: ".$this->strategy->getName()."\n\n";
        $string .= '// Attacker Units //'."\n";
        $string .= $this->offUnits->toString()."\n";
        $string .= '// Defender Units //'."\n";
        $string .= $this->defUnits->toString()."\n";

        echo $string;
    }

    /**
     * Return points
     *
     * @param $direction
     *
     * @return float|int
     * @throws Exception
     */
    private function fireOn($direction)
	{
		if ($direction == 'def')
		{
			$offUnits = $this->offUnits;
			$defUnits = $this->defUnits;
		}
		else if ($direction == 'off')
		{
			$offUnits = $this->defUnits;
			$defUnits = $this->offUnits;
		}
		else
			throw new Exception ('Direction type >'.$direction.'< is unknown');

        // total amount of attacks for each three kinds
        $sumAtt = $this->sumAtt($offUnits);

        $sumUnitsNb = Tool::sum($offUnits->get('unitsNb'));

        // we generate a fake distribution of the defender units in order to add the so called RandomEvent
        $fakeDistrib = Tool::newDistrib($defUnits->get('unitsNb'),60);

        debug($nbFiring = $this->nbFiring($sumUnitsNb, $fakeDistrib), "nb Firing");

        // amount of damages fired on each def units by type
        debug($dmgFired = $this->dmgFired($defUnits, $fakeDistrib, $sumAtt), "dmg Fired");

        debug($nbTouched = $this->nbTouched($nbFiring,$defUnits), "nb Touched");

        debug($dmgBlocked = $this->dmgBlocked($nbTouched, $defUnits), "dmg Blocked");

        debug($nbKilled = $this->nbKilled($dmgFired, $dmgBlocked, $nbTouched), "nb Killed");

        // total amount of points for each def units by type
        debug($nbPoints = $this->nbPoints($nbTouched, $nbKilled, $defUnits), "nb Points");

        debug($sumPoints = Tool::sum($nbPoints), "sum Points");

        return $sumPoints;
    }

    /**
     * Sum of the three kinds attacks
     *
     * @param UnitArray $offUnits
     *
     * @return array[3]
     */
    private function sumAtt($offUnits)
    {
        $sumAtt = array(0,0,0);

        $units = $offUnits->get('units');
        $unitsNb = $offUnits->get('unitsNb');

        for ($i=0; $i < $this->size(); $i++)
        {
            $att = $units[$i]->get('att');
            $nb = $unitsNb[$i];

            $sumAtt[0] += $att[0] * $nb;
            $sumAtt[1] += $att[1] * $nb;
            $sumAtt[2] += $att[2] * $nb;
        }

        return $sumAtt;
    }

    /**
     * @param array $sumUnitsNb
     * @param array $fakeDistrib
     *
     * @return array
     */
    private function nbFiring($sumUnitsNb, $fakeDistrib)
    {
        $nbFiring = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $nbFiring[] = $sumUnitsNb * $fakeDistrib[$i] / 100;
        }
        return $nbFiring;
    }

    /**
     * @param UnitArray $defUnits
     * @param array $fakeDistrib
     * @param array[3] $sumAtt
     *
     * @return array
     */
    private function dmgFired($defUnits, $fakeDistrib, $sumAtt)
    {
        $dmgFired = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $kind = $defUnits->get('units')[$i]->get('kind');
            $dmgFired[] = $fakeDistrib[$i] * $sumAtt[$kind] / 100;
        }
        return $dmgFired;
    }

    /**
     * @param array $nbFiring
     * @param UnitArray $defUnits
     *
     * @return array
     */
    private function nbTouched($nbFiring, $defUnits)
    {
        $nbTouched = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $nb = $defUnits->get('unitsNb')[$i];
            $nbTouched[] = $nbFiring[$i] / ($nbFiring[$i] + $nb) * $nb;
        }
        return $nbTouched;
    }

    /**
     * @param array $nbTouched
     * @param array $nbKilled
     * @param UnitArray $defUnits
     *
     * @return array
     */
    private function nbPoints($nbTouched, $nbKilled, $defUnits)
    {
        $nbPoints = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $destroy_bonus = $defUnits->cost($i);
            $nbPoints[] = ($nbTouched[$i] * 1 + $nbKilled[$i] * $destroy_bonus);
        }
        return $nbPoints;
    }

    /**
     * @param array $dmgFired
     * @param array $dmgBlocked
     * @param array $nbTouched
     *
     * @return array
     */
    private function nbKilled($dmgFired, $dmgBlocked, $nbTouched)
    {
        $nbKilled = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $nbKilled[] = $dmgFired[$i] / $dmgBlocked[$i] * $nbTouched[$i];
        }
        return $nbKilled;
    }

    /**
     * @param array $nbTouched
     * @param UnitArray $defUnits
     *
     * @return array
     */
    private function dmgBlocked($nbTouched, $defUnits)
    {
        $dmgBlocked = array();

        for ($i=0; $i < $this->size(); $i++)
        {
            $dmgBlocked[] = $defUnits->get('units')[$i]->get('armor') * $nbTouched[$i];
        }
        return $dmgBlocked;
    }


















	

}