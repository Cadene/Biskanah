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

    public function afterFind($results, $primary=false)
    {
        foreach ($results as $k=>$v)
        {
            $results[$k]['UnitsCamp']['type'] = $results[$k]['UnitsCamp']['dataunit_id'];
        }

        return $results;
    }
}
