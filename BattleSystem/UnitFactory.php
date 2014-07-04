<?php

class UnitFactory {
	
	public static function makeScout()
	{
		$name = 'Scout';
		$kind = 0;
		$conso = 1;
		$capacity = 100;
		$att = array(25,10,5);
        $armor = 100;
		$res = array(10,10,10);

		return new Unit($name, $kind, $conso, $capacity, $att, $armor, $res);
	}

	public static function makeMedic()
	{
		$name = 'Medic';
		$kind = 0;
		$conso = 1;
		$capacity = 500;
		$att = array(15,5,5);
        $armor = 200;
		$res = array(10,10,10);

		return new Unit($name, $kind, $conso, $capacity, $att, $armor, $res);
	}
}