<?php
App::uses('AppModel', 'Model');
/**
 * Dataunit Model
 *
 */
class Datanode extends AppModel {

    public $actsAs = array('Data');


    public function findByKind($kind){
        return $this->find('all',array(
            'conditions' => array(
                'to_kind' => $kind
            ),
            'fields' => array(
                'from_data', 'from_kind', 'to_data'
            )
        ));
    }

    public function findByData($data,$kind){
        return $this->find('all',array(
            'conditions' => array(
                'to_data' => $data,
                'to_kind' => $kind
            ),
            'fields' => array(
                'from_data', 'from_kind', 'to_data'
            )
        ));
    }

}
