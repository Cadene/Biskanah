<?php
App::uses('AppModel', 'Model');
/**
 * CampsUnit Model
 *
 * @property Camp $Camp
 * @property Unit $Unit
 */
class UnitsCamp extends AppModel {

    public function findAllByCamp($camp_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'UnitsCamp.camp_id' => $camp_id
            )
        ));
        return $tmp;
    }
}
