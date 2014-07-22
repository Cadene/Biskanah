<?php
    require('config/database.php');

    require('src/DB.php');

    $db = new DB();

    $camp = $db->select('camps',
        array('last_update'),
        array('id = 1'));

    foreach ($camp as $c)
        var_dump($c['last_update']);