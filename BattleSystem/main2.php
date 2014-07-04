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

$array = array(50,50);

debug($nArray = Tool::newDistrib($array,30));
debug(Tool::variance($nArray));

} catch (Exception $e) {

echo $e->getMessage();
}