<?php
App::uses('AppModel', 'Model');
/**
 * Building Model
 *
 * @property Camp $Camp
 * @property Dtbuilding $Dtbuilding
 * @property Dttechno $Dttechno
 * @property Dtunit $Dtunit
 */
class Building extends AppModel {

    public $actsAs = array('Data');


    /**
     * Retourne la liste des buildings indexés par type
     *
     * @param $camp_id
     *
     * @return mixed
     */
    public function findByCampId($camp_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Building.camp_id' => $camp_id
            )
        ));

        if (empty($tmp))
            return $tmp;

        foreach ($tmp as $k=>$v)
        {
            $v = $v['Building'];
            $type = $v['databuilding_id'];
            $rslt[$type]['Building'] = $v;
        }

        return $rslt;

    }

    public function findById($id)
    {
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Building.id' => $id
            )
        ));

        if(empty($tmp))
            return $tmp;

        return $tmp['Building'];
    }


    public function dtUpdate($dt)
    {
        return $this->updateAll(
            array('Building.lvl' => 'Building.lvl + 1'),
            array('Building.id' => current($dt)['building_id']
        ));
    }

}
