<?php

define ('PC_RAND_MAX', 20);

require_once 'functions.php';
require_once 'Tool.php';
require_once 'Unit.php';
require_once 'UnitArray.php';
require_once 'Strategy.php';
require_once 'Battle.php';
require_once 'UnitFactory.php';

try {

    /* Units creation */

	$scout = UnitFactory::makeScout();
	$medic = UnitFactory::makeMedic();

	echo $scout->toString()."\n";

    /* Units type */

	$unitsType = array($scout,$medic);

    /* Units numbers for each player */

	$offUnitArray = new UnitArray($unitsType, array(10,2));
	$defUnitArray = new UnitArray($unitsType, array(2,1));

	echo $defUnitArray->toString()."\n";

    /* Battle type */

    $raid = new Strategy('raid',33);
    $destruction = new Strategy('destruction',66);
    $capture = new Strategy('capture',100);

	$battle = new Battle($offUnitArray, $defUnitArray, $raid);

	$battle->fight();

} catch (Exception $e) {

	echo $e->getMessage();
}
