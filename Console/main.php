<?php

require_once('config/database.php');

require_once('src/Element.php');

foreach (glob('src/*.php') as $filename)
{
    require_once $filename;
}



$db = new DB();
$biskanah = Factory::makeBiskanah();
$biskanah->generateAll($db);