<?php

    require_once ('src/Element.php');
    require_once ('src/Building.php');

$building = new Building(1);

print_r($building->toValues());