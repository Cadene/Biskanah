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

    public function execute($sql_query)
    {
        $bdd->exec($sql_query);
    }
	public function worldsGenerate($max_x,$max_y){
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

}

$bdd = new BDD();

$bdd->worldsGenerate(100,100);



