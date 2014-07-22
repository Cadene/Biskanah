<?php

    require_once('config/database.php');

    require_once('src/Element.php');

    // 'php main.php' pour exec sinon fail
    foreach (glob('src/*.php') as $filename)
    {
        require_once $filename;
    }

    $db = new DB();

    $server = new Server($db);

    echo 'Serveur en ligne '.gmdate("M D Y H:i:s", time()+2*3600)."\n...\n";

    while (true)
    {
        $server->updateAll();
        sleep(1);
    }


