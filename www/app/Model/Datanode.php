<?php
App::uses('AppModel', 'Model');
/**
 * Dataunit Model
 *
 */
class Datanode extends AppModel {

    public $actsAs = array('Data');

    /**
     * Rend tous les prérequis pour tous les buildings
     *
     * @return array
     */
    public function findNodes($nodes='buildings')
    {
        if ($nodes === 'buildings') {
            $kind = 1;
        } else {
            $kind = 2;
        }

        return $this->findByKind('to',$kind);
    }

    public function findByKind($direction,$kind)
    {
        $opDir = $this->_oppositeDirection($direction);

        $rslt = $this->find('all',array(
            'conditions' => array(
                $direction.'_kind' => $kind
            ),
            'fields' => array(
                '*'
            )
        ));

        return $rslt;
    }

    /**
     * @param        $kind [0,1,2:unit]
     * @param        $type
     * @param string $direction [from|to]
     *
     * @return array
     */
    public function findBy($direction,$kind,$type)
    {
        $opDir = $this->_oppositeDirection($direction);

        $rslt = $this->find('all',array(
            'conditions' => array(
                $direction.'_kind' => $kind,
                $direction.'_type' => $type,
            ),
            'fields' => array(
                '*'
            )
        ));

        return $rslt;
    }

    private function _oppositeDirection($direction)
    {
        if ($direction == 'from')
            return 'to';

        if ($direction == 'to')
            return 'from';

        throw new NotFoundException(__('Invalid Direction'));
    }

}
