<?php

class Datanodes {

    private $datanodes;

    private $keys = array('from_kind','from_type','from_lvl','to_kind','to_type');

    public function __construct($datanodes)
    {
        $this->datanodes = $datanodes;
    }

    public function generate($db)
    {
        $table = 'datanodes';

        $i = 0;
        foreach ($this->datanodes as $to_kind => $datanode)
        {
            foreach ($datanode as $to_type => $dn)
            {
                foreach ($dn as $from_type => $from_lvl)
                {
                    $values[$i]['from_kind'] = $to_kind;
                    $values[$i]['from_type'] = $from_type;
                    $values[$i]['from_lvl'] = $from_lvl;
                    $values[$i]['to_kind'] = $to_kind;
                    $values[$i]['to_type'] = $to_type;

                    $i++;
                }
            }
        }

        $db->insertAll($table,$this->keys,$values);
    }
}