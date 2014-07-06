<?php

class World {

    // length of a side
    protected $length;

    public function __construct($length)
    {
        $this->length = $length;
    }

    public function get($att)
    {
        return $this->$att;
    }

    public function generate($db)
    {
        $table = 'worlds';
        $key = array('x','y','type');
        $values = array();
        $len = $this->get('length');
        $max_x = $len;
        $max_y = $len;

        for($i=0-$max_x; $i<$max_x; $i++)
        {
            for($j=0-$max_y; $j<$max_y; $j++)
            {
                $values[] = array(
                    'x' => $i,
                    'y' => $j,
                    'type' => 0
                );
            }
        }

        $db->insertAll($table,$key,$values);
    }
}