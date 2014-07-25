<?php
App::uses('AppModel', 'Model');
/**
 * World Model
 *
 * @property Camp $Camp
 */
class World extends AppModel {

    /**
     * generateCamp method
     *
     * @var array
     */
    //TODO don't use rand to choose
    public function generateFirstCamp()
    {
        $d['World']['type'] = 0;
        $d['World']['occupied'] = 1;

        $rayon = sqrt($this->getSize()) / 2;
        $d['World']['x'] = rand(-$rayon-1,$rayon-1);
        $d['World']['y'] = rand(-$rayon-1,$rayon-1);

        $q = $this->query('SELECT id FROM Worlds '
            . ' WHERE x = '.$d['World']['x']
            . ' AND y = '.$d['World']['y'].' LIMIT 1;');
        $d['World']['id'] = $q[0]['Worlds']['id'];

        $this->query('UPDATE Worlds '
            . 'SET type = '.$d['World']['type'].', occupied = '.$d['World']['occupied']
            . ' WHERE id = '.$d['World']['id'].';');

        return $d['World']['id'];
    }

    /**
     * Generate a square world
     *
     * @param $world World
     */
    public function generate($world)
    {
        $length = $world->get('length');
        $max_x = $length;
        $max_y = $length;

        $data = array();

        for($i=0-$max_x; $i<$max_x; $i++)
        {
            for($j=0-$max_y; $j<$max_y; $j++)
            {
                $data[] = array(
                    'x' => $i,
                    'y' => $j,
                    'type' => 0
                );
            }
        }

        $this->saveMany($data);
    }

    private function getSize(){
        $q = $this->query('SELECT COUNT(*) AS size_world FROM Worlds');
        return $q[0][0]['size_world'];
    }

}
