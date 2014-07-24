<?php
App::uses('AppModel', 'Model');
/**
 * Dttechno Model
 *
 * @property Techno $Techno
 * @property Building $Building
 */
class Dttechno extends AppModel {


    public function findByBuildingId($building_id){
	    return $this->find('all',array(
	        'recursive' => -1,
	        'conditions' => array(
	            'Dttechno.building_id' => $building_id
	        ),
	        'fields' => array('*')
	    ));
    }

    public function findByDatatechno($datatechno_id)
    {
        return $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dttechno.datatechno_id' => $datatechno_id
            ),
            'fields' => array('*')
        ));
    }

    // TODO à enlever ?
    public function lastByBuildingId($building_id){
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Dttechno.building_id' => $building_id
            ),
            'order' => array(
                'Dttechno.id DESC'
            ),
            'fields' => array('*')
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['Dttechno'];
    }

    public function findByUserId($user_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dttechno.user_id' => $user_id
            ),
            'order' => array(
                'Dttechno.id DESC'
            ),
            'fields' => array('*')
        ));

        return $tmp;
    }

    public function getFinished()
    {
        return $this->find('all',array(
            'conditions' => array(
                'Dttechno.finish < '.time()
            ),
            'fields' => array('*')
        ));
    }

    public function deleteFinished()
    {
        return $this->deleteAll(array('finish < '.time()),false);
    }






}
