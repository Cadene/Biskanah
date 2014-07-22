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
			echo 'N° : '.$e->getCode();
		}
	}

    /**
     * Execute la requête $sql et renvoie un objet itérable dans le cas d'un Select
     *
     * @param $sql
     *
     * @return PDOStatement
     */
    public function query($sql)
    {
        return $this->db->query($sql);
    }

    /**
     * @param      $table
     * @param      $keys
     * @param      $values
     * @param bool $toString
     *
     * @return PDOStatement|string
     */
    public function insertAll($table,$keys,$values,$toString=false)
    {
        $sql = 'INSERT INTO `'.$table.'` (';

        $sql .= $this->_keys($keys);

        $sql .= ') VALUES ';
        $firstValues = true;

        foreach ($values as $value)
        {
            if (!$firstValues)
            {
                $sql .= ', ';
            }
            else
            {
                $firstValues = false;
            }
            
            $sql .= '(';
            $firstValue = true;
            foreach ($value as $v)
            {
                if (!$firstValue)
                {
                    $sql .= ', ';
                }
                else
                {
                    $firstValue = false;
                }
                $sql .= '"'.$v.'"';
            }
            $sql .= ')';
        }

        return $this->_doToString($sql,$toString);
    }

    /**
     * @param       $table
     * @param       $keys
     * @param array $conditions
     * @param bool  $toString
     *
     * @return mixed
     */
    public function select($table,$keys,$conditions=[],$toString=false)
    {
        $sql = 'SELECT ';

        $sql .= $this->_keys($keys);

        $sql .= ' FROM '.$table;

        $sql .= $this->_conditions($conditions);

        return $this->_doToString($sql,$toString);
    }

    /**
     * @param      $table
     * @param      $keys
     * @param      $conditions
     * @param bool $toString
     *
     * @return PDOStatement|string
     */
    public function update($table,$keys,$conditions=[],$toString=false)
    {
        $sql = 'UPDATE '.$table.' SET ';

        $sql .= $this->_sets($keys);

        $sql .= $this->_conditions($conditions);

        return $this->_doToString($sql,$toString);
    }

    /**
     * @param       $table
     * @param array $conditions
     * @param bool  $toString
     *
     * @return PDOStatement|string
     */
    public function delete($table,$conditions=[],$toString=false)
    {
        $sql = 'DELETE FROM '.$table;

        $sql .= $this->_conditions($conditions);

        return $this->_doToString($sql,$toString);
    }


    /**
     * @param $keys
     *
     * @return string
     */
    private function _keys($keys)
    {
        $sql = '';
        $firstKey = true;
        foreach($keys as $key)
        {
            if (!$firstKey)
            {
                $sql .= ', ';
            }
            else
            {
                $firstKey=false;
            }

            if ($key === '*')
            {
                $sql .= $key;
            }
            else
            {
                $sql .= '`'.$key.'`';
            }
        }
        return $sql;
    }

    /**
     * @param $keys
     *
     * @return string
     */
    private function _sets($keys)
    {
        $sql = '';
        $firstSet = true;
        foreach ($keys as $set)
        {
            if (!$firstSet)
            {
                $sql .= ', ';
            }
            else
            {
                $firstSet = false;
            }
            $sql .= $set;
        }
        return $sql;
    }

    /**
     * @param array $conditions
     *
     * @return string
     */
    private function _conditions($conditions)
    {
        $sql = '';
        if (!empty($conditions))
        {
            $firstCondition=true;
            foreach($conditions as $condition)
            {
                if(!$firstCondition)
                {
                    $sql.=' AND ';
                }
                else
                {
                    $firstCondition=false;
                    $sql.=' WHERE ';
                }
                $sql .= $condition;
            }
        }
        return $sql;
    }

    /**
     * @param $sql
     * @param $toString
     *
     * @return PDOStatement|string
     */
    private function _doToString($sql,$toString)
    {
        $sql .= ';'."\n";

        if ($toString === true)
        {
            return $sql;
        }
        else
        {
            return $this->db->query($sql);
        }
    }

    /**
     * @param PDOStatement $selectPDO
     *
     * @return array
     */
    public function pdoToArray(PDOStatement $selectPDO)
    {
        $result = [];
        foreach ($selectPDO as $copy)
        {
            $result[] = $copy;
        }
        return $result;
    }

	
	
		
	
}