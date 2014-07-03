<?php

class Unit {

	private $name;

	private $kind;

	private $conso;

	private $capacity;

	private $att;

    private $armor;
	
	private $res;


	public function __construct($name, $kind, $conso, $capacity, Array $att, $armor, Array $res)
	{
		$this->name = $name;
		$this->kind = $kind;
		$this->conso = $conso;
		$this->capacity = $capacity;
		$this->att = $att;
        $this->armor = $armor;
		$this->res = $res;
	}

	public function get($attribut)
	{
		return $this->$attribut;
	}

	public function toString()
	{
		$rslt = 'Name: '.$this->name."\n";
		$rslt .= 'Kind: '.$this->kind."\n";
		$rslt .= 'Att: ['.$this->att[0].','.$this->att[1].','.$this->att[2].']'."\n";
        $rslt .= 'Armor: '.$this->armor."\n";
		$rslt .= 'Res: ['.$this->res[0].','.$this->res[1].','.$this->res[2].']'."\n";
		$rslt .= 'Conso: '.$this->conso."\n";
		$rslt .= 'Capacity: '.$this->capacity."\n";

		return $rslt;
	}

}