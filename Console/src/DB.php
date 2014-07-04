<?php



/*
 * Base de donnée MySQL
 *
 */

class DB{
	
	protected $db;
	
	public function __construct(
		$host=DATABASE_host,
		$port=DATABASE_port,
		$name=DATABASE_nom_bd,
		$user=DATABASE_utilisateur,
		$pass=DATABASE_mot_passe
	){
		try {
			$db = new PDO($host.';dbname='.$name, $user, $pass);
			$db->exec("set names utf8");
			$this->db = $db;
		}
		catch(Exception $e){
			echo 'Erreur : '.$e->getMessage().'<br />';
			echo 'N�� : '.$e->getCode();
		}
	}

    public function query($sql){
        return $this->db->query($sql);
    }

    public function insertAll($table,&$key,&$values)
    {
        $sql = 'INSERT INTO `'.$table.'` (';

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

        return $this->db->query($sql);
    }

    public function select($table,$keys,$conditions)
    {
        $sql = 'SELECT ';

        $firstKey=true;
        foreach($keys as $key)
        {
            if(!$firstKey){ $sql.=', '; }else{ $firstKey=false; }
            $sql .= '`'.$key.'`';
        }

        $sql.= ' FROM '.$table;;
        $firstCondition=true;
        foreach($conditions as $condition)
        {
            if(!$firstCondition){
                $sql.=' AND ';
            }else{
                $firstCondition=false;
                $sql.=' WHERE ';
            }
            $sql .= $condition;
        }

        return $this->db->query($sql);
    }

    public function update($table,&$sets,&$conditions)
    {
        $sql = 'UPDATE '.$table.' SET ';

        $firstSet=true;
        foreach($sets as $set)
        {
            if(!$firstSet){ $sql.=', '; }else{ $firstSet=false; }
            $sql .= $set;
        }

        $sql.= ' WHERE ';
        $firstCondition=true;
        foreach($conditions as $condition)
        {
            if(!$firstCondition){ $sql.=' AND '; }else{ $firstCondition=false; }
            $sql .= $condition;
        }

        return $this->db->query($sql);
    }
    


	
	
		
	
}