<?php

    App::uses('AppModel', 'Model');
/**
* Dataunit Model
*
*/
class Datanode extends AppModel {

    public function verify($to_data,&$data){
        $d = $this->find('all',array(
            'conditions' => array(
                'to_data' => $to_data
            )
        ));
        debug($d);
        die();
    }

}