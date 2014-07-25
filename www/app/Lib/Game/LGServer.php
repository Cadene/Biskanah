<?php

class LGServer {

    protected $world;

    protected $buildings;

    protected $technos;

    protected $units;

    protected $requisits;

	
	public function __construct($world, $buildings, $technos, $units, $requisits)
    {
		$this->world = $world;
        $this->buildings = $buildings;
        $this->technos = $technos;
        $this->units = $units;
        $this->requisits = $requisits;
	}





}




