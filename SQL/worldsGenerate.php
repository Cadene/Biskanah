<?php

define( 'DATABASE_hote' , '127.0.0.1' ); // le chemin vers le serveur
define( 'DATABASE_port' , '3306' );
define( 'DATABASE_nom_bd' , 'BiskanahV1' ); // le nom de votre base de données
define( 'DATABASE_utilisateur' , 'root' ); // nom d'utilisateur pour se connecter
define( 'DATABASE_mot_passe' , 'root' ); // mot de passe de l'utilisateur pour se connecter

class BDD{
	
	protected $bdd;
	
	public function __construct(
		$hote=DATABASE_hote,
		$port=DATABASE_port,
		$name=DATABASE_nom_bd,
		$user=DATABASE_utilisateur,
		$pass=DATABASE_mot_passe
	){
		try {
			$bdd = new PDO('mysql:host='.$hote.';dbname='.$name, $user, $pass);
			$bdd->exec("set names utf8");
			$this->bdd = $bdd;
		}
		catch(Exception $e){
			echo 'Erreur : '.$e->getMessage().'<br />';
			echo 'N�� : '.$e->getCode();
		}
	}

	public function generateWorlds($max_x,$max_y){
		$nb=0;
		for($i=0-$max_x; $i<$max_x; $i++){
		    for($j=0-$max_y; $j<$max_y; $j++){
		    	$sql = 'INSERT INTO `BiskanahV1`.`worlds` (`x`, `y`, `type`) VALUES ('.$i.', '.$j.', 0);';
		        $this->bdd->query($sql);
		        //sleep(1);
		        if($nb%200==0)
		        	echo $nb." ".$sql."\n";
		    	$nb++;
		    }
		}
	}

    public function generateDatabuildings(){
        $values = array();
        $key = array('id','lvl','res1','res2','res3','struct','conso','time');
        for($type=0; $type<20; $type++){
            for($lvl=0; $lvl<100; $lvl++){
                $values[] = array(
                    'id' => ($type*100)+$lvl,
                    'lvl' => $lvl,
                    'res1' => 3*$lvl,
                    'res2' => 2*$lvl,
                    'res3' => 1*$lvl,
                    'struct' => 100*$lvl,
                    'conso' => $lvl,
                    'time' => 5*$lvl
                );
            }
        }
        $this->insertAll('Databuildings',$key,$values);
    }


    public function insertAll($table,&$key,&$values)
    {
    	$sql = 'INSERT INTO `BiskanahV1`.`'.$table.'` (';

    	$firstKey=true;
    	foreach($key as $k)
    	{
    		if(!$firstKey){ $sql.=', '; }else{ $firstKey=false; }
    		$sql .= '`'.$k.'`';
    	}

    	$sql .= ') VALUES ';
		$firstValues=true;
		foreach($values as $value)
		{
    		if(!$firstValues){ $sql.=', '; }else{ $firstValues=false; }
    		
    		$sql .= '(';
    		$firstValue=true;
    		foreach($value as $v)
    		{
				if(!$firstValue){ $sql.=', '; }else{ $firstValue=false; }
				$sql .= '"'.$v.'"';
			}
			$sql .= ')';
    	}

    	return $this->bdd->query($sql);
    }

}

$bdd = new BDD();

$bdd->generateWorlds(100,100);



