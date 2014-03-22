<?php

include_once('src/BDD.php');

class Biskanah {
	
	protected $bdd;
	
	public function __construct(){
		$this->bdd = new BDD();
	}


    public function generateAll(){
        $this->generateWorlds(100,100);
        $this->generateDatabuildings();
    }

    public function generateWorlds($max_x,$max_y){
        $table = 'Worlds';
        $key = array('x','y','type');
        $values = array();
        $nb=0;
        for($i=0-$max_x; $i<$max_x; $i++){
            for($j=0-$max_y; $j<$max_y; $j++){
                $values[] = array(
                    'x' => $i,
                    'y' => $j,
                    'type' => 0
                );
            }
        }
        $this->bdd->insertAll($table,$key,$values);
    }

    public function generateDatabuildings(){
        $table = 'Databuildings';
        $key = array('id','lvl','type','res1','res2','res3','struct','conso','time');
        $values = array();
        for($type=0; $type<20; $type++){
            for($lvl=0; $lvl<100; $lvl++){
                $values[] = array(
                    'id' => ($type*100)+$lvl,
                    'lvl' => $lvl,
                    'type' => $type,
                    'res1' => 3*$lvl,
                    'res2' => 2*$lvl,
                    'res3' => 1*$lvl,
                    'struct' => 100*$lvl,
                    'conso' => $lvl,
                    'time' => 5*$lvl
                );
            }
        }
        $this->bdd->insertAll($table,$key,$values);
    }

}



