<?php

class UnitArray {
	
	private $units;
	private $unitsNb;

	private $unitsPc;

	private $size;

	public function __construct(Array $units, Array $unitsNb)
	{
		$this->units = $units;
		$this->unitsNb = $unitsNb;

		if (($size = count($this->units)) != count($this->unitsNb))
			throw new Exception('Different attributs size');
		$this->size = $size;

		$this->unitsPc = Tool::toPc($unitsNb);
	}

	public function get($attribut)
	{
		return $this->$attribut;
	}

	public function size()
	{
		return $this->size;
	}

    public function cost($i)
    {
        $cost = 0;

        foreach (array(1, 1.5, 2) as $res => $bonus)
        {
            $cost += $this->units[$i]->get('res')[$res] * $bonus;
        }
        return $cost;
    }

	public function toString()
	{
		$size = $this->size();
		$rslt = '';//'Size: '.$size."\n";
		
		if ($size > 0)
		{
			$rslt .= "{\n";

			for ($i=0; $i<$size; $i++)
			{
				if (($nb=$this->unitsNb[$i]) > 0)
				{
					$name = $this->units[$i]->get('name');
					$pc = $this->unitsPc[$i];
					$rslt .= '  '.$nb.' '.$name.'s for '.$pc."%\n";
				}
			}

			$rslt .= "}\n";
		}
		return $rslt;
	}


	
}