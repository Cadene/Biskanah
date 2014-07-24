<?php
App::uses('AppModel', 'Model');
/**
 * Dtbuilding Model
 *
 * @property Building $Building
 */
class Dtbuilding extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Building' => array(
			'className' => 'Building',
			'foreignKey' => 'building_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);



    public function findByBuildingId($building_id){
        return $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dtbuilding.building_id' => $building_id
            ),
            'fields' => array('*')
        ));
    }

    public function findByDatabuilding($databuilding_id)
    {
        return $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dtbuilding.databuilding_id' => $databuilding_id
            ),
            'fields' => array('*')
        ));
    }

    public function findByCampId($camp_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Dtbuilding.camp_id' => $camp_id
            ),
            'order' => array(
                'Dtbuilding.id DESC'
            ),
            'fields' => array('*')
        ));

        return $this->_afterFind($tmp);
    }

    public function getFinished()
    {
        $results = $this->find('all',array(
            'conditions' => array(
                'finish < '.time()
            ),
            'fields' => array('*')
        ));
        return $results;
    }

    public function deleteFinished()
    {
        return $this->deleteAll(array('finish < '.time()),false);
    }


    /**
     * Ajoute le niveau
     *
     * @param $results
     *
     * @return mixed
     */
    public function _afterFind($results)
    {
        App::uses('Data','Controller/Component');
        $this->Data = new DataComponent(new ComponentCollection());
        $buildings = $this->Data->read('Buildings');

        for($type=0; $type<=18; $type++)
        {
            if (isset($buildings[$type]))
            {
                $lvlByTypes[] = current($buildings[$type])['lvl'];
            }
            else
            {
                $lvlByTypes[] = 0;
            }
        }

        for ($i=count($results)-1; $i>=0; $i--)
        {
            $dtb = $results[$i]['Dtbuilding'];
            $type = $dtb['databuilding_id'];

            $lvlByTypes[$type]++;

            $results[$i]['Dtbuilding']['lvl'] = $lvlByTypes[$type];
        }


        return $results;
    }


}
