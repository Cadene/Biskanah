<?php

class Biskanah {

    protected $world;

    protected $buildings;

    protected $technos;

    protected $units;

	
	public function __construct($world, $buildings, $technos, $units)
    {
		$this->world = $world;
        $this->buildings = $buildings;
        $this->technos = $technos;
        $this->units = $units;
	}


    public function generateAll($db)
    {
        $this->world->generate($db);
        $this->buildings->generate($db);
        $this->technos->generate($db);
        $this->units->generate($db);
    }




}




