<?php
App::uses('AppModel', 'Model');
/**
 * Dtunit Model
 *
 * @property Unit $Unit
 * @property Building $Building
 */
class Dtunit extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public function findAllByBuilding($building_id)
    {
        $results = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dtunit.building_id' => $building_id
            ),
            'fields' => array('*')
        ));
        return $this->_afterFind($results);
    }

    private function _afterFind($results)
    {
        foreach ($results as $k=>$v)
        {
            $finish = $results[$k]['Dtunit']['finish'];
            $begin = $results[$k]['Dtunit']['begin'];
            $num = $results[$k]['Dtunit']['num'];

            $newUnits = floor( (time() - $begin) / (($finish - $begin) / $num) );
            $results[$k]['Dtunit']['num'] -= $newUnits;
        }

        return $results;
    }


    public function getFinished()
    {
        return $this->find('all',array(
            'conditions' => array(
                'Dtunit.finish < '.time()
            ),
            'fields' => array('*')
        ));
    }

    public function deleteFinished()
    {
        return $this->deleteAll(array('Dtunit.finish < '.time()),false);
    }

}
