<?php

class LoadTask extends Shell {

    public function execute()
    {
        App::uses('Element','Lib/Game');
        App::uses('DB','Lib/Game');
        App::uses('Biskanah','Lib/Game');
        App::uses('Techno','Lib/Game');
        App::uses('Technos','Lib/Game');
        App::uses('Building','Lib/Game');
        App::uses('Buildings','Lib/Game');
        App::uses('Unit','Lib/Game');
        App::uses('Units','Lib/Game');
        App::uses('World','Lib/Game');
        App::uses('Datanodes','Lib/Game');
        App::uses('Factory','Lib/Game');
        App::uses('Server','Lib/Game');
    }
}