<?php
App::uses('AppModel', 'Model');
/**
 * Datatechno Model
 *
 */
class Datatechno extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'lvl' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'type' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'res1' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'res2' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'res3' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'time' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    public function findByIdLvl($id,$lvl,$buildings,$technos)
    {
        $data = $this->findById($id);
        return $this->_afterFind($id,$lvl,$buildings,$technos,$data);
    }

    public function _afterFind($id,$lvl,$buildings,$technos,$data)
    {
        // TODO rajouter les valeurs de structures, le temps de construction, etc.
        $res = $this->_costInRes($id,$lvl,$data);
        $data['res1'] = $res[1];
        $data['res2'] = $res[2];
        $data['res3'] = $res[3];

        if (isset($buildings[10]))
            $bat10 = $buildings[10]['Building']['lvl'];
        else
            $bat10 = 0;

        if (isset($technos[8]))
            $tech8 = $technos[8]['Techno']['lvl'];
        else
            $tech8 = 0;

        $data['time'] = $this->_consTime($res[1],$res[2],$res[3],$bat10,$tech8);
        $data['lvl'] = $lvl;

        return $data;
    }

    public function findByIdLvlBetween($id,$firstLvl,$nbLvl,$buildings,$technos)
    {
        $datatechno = $this->findById($id);
        $data = [];
        for ($lvl=$firstLvl; $lvl <= $nbLvl; $lvl++)
        {
            $data['Datatechnos'][$lvl] = $this->_afterFind($id,$lvl,$buildings,$technos,$datatechno);
        }
        $data['Datatechno'] = $data['Datatechnos'][$firstLvl];

        return $data;
    }


    private function _consTime($res1,$res2,$res3,$bat10,$tech8)
    {
        return ($res1 + $res2 + $res3) / (5 * (1 + $bat10 + $tech8));
    }

    private function _costInRes($id, $lvl, Array $data)
    {

        $res[1] = $data['res1'] * pow(2, $lvl-1);
        $res[2] = $data['res2'] * pow(2, $lvl-1);
        $res[3] = $data['res3'] * pow(2, $lvl-1);

        return $res;
    }

    public function findById($id){
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Datatechno.id' => $id
            )
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['Datatechno'];
    }
}
