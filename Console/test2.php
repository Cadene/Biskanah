<?php

require_once('config/database.php');

foreach (glob('src/*.php') as $filename)
{
    require_once $filename;
}

$db = new DB();

$keys = ['id','from'];

$conditions = ['id < 3','from > 5'];

echo $db->delete('table',$conditions,true);

