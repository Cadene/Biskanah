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
        return $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dtunit.building_id' => $building_id
            ),
            'fields' => array('*')
        ));
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
