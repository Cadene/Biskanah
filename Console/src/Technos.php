<?php

class Technos {

    protected $technos;

    public function __construct($technos=array())
    {
        $this->technos = $technos;
    }

    public function generate($db)
    {
        $table = 'datatechnos';

        foreach ($this->technos as $techno)
        {
           $values[] = $techno->toValues();
        }

        $db->insertAll($table,Techno::getKeys(),$values);
    }

}