<?php
App::uses('AppModel', 'Model');
/**
 * Databuilding Model
 *
 */
class Databuilding extends AppModel {


    public $actsAs = array('Data');
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
		'struct' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'conso' => array(
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

    public function findById($id){
        $tmp = $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
        return $tmp['Databuilding'];
    }

    public function findByIdLvl($id,$lvl,$buildings,$technos)
    {
        $tmp = $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
        $data = $tmp['Databuilding'];

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

        // hangars
        if ($id == 4 || $id == 5 || $id == 6)
            $data['stock'] = $this->_stock($lvl);

        // extracteurs
        if ($id == 1 || $id == 2 || $id == 3)
            $data['prod'] = $this->_prod($id, $lvl);

        $data['lvl'] = $lvl;

        return $data;
    }

    public function findByIdLvlBetween($id,$firstLvl,$nbLvl,$buildings,$technos)
    {
        $tmp = $this->find('first', array(
            'conditions' => array('id' => $id)
        ));
        $databuilding = $tmp['Databuilding'];

        $data = [];
        for ($lvl=$firstLvl; $lvl <= $nbLvl; $lvl++)
        {
            $data['Databuildings'][$lvl] = $this->_afterFind($id,$lvl,$buildings,$technos,$databuilding);
        }
        $data['Databuilding'] = $data['Databuildings'][$firstLvl];

        return $data;
    }

    private function _prod($id,$lvl)
    {
        if ($id == 1)
            $coef = 30;
        else if ($id == 2)
            $coef = 20;
        else
            $coef = 10;

        return $coef * $lvl * pow(1.1, $lvl);
    }

    private function _stock($lvl)
    {
        if ($lvl == 0)
            return 100000;
        else
        {
            return 100000 + 50000 * floor(pow(1.6, $lvl));
        }
    }

    private function _consTime($res1,$res2,$res3,$bat10,$tech8)
    {
        // TODO 0.5 peut être trop abusé
        return ($res1 + $res2 + $res3) / 5.000 * (2 / (1 + $bat10)) * pow(0.5, $tech8);
    }

    private function _costInRes($id, $lvl, Array $data)
    {
        // Extracteur de métal
        if ($id == 1)
        {
            $res[1] = 60 * pow(1.5, $lvl-1);
            $res[2] = 15 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($id == 2)
        {
            $res[1] = 48 * pow(1.6, $lvl-1);
            $res[2] = 24 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else if ($id == 3)
        {
            $res[1] = 225 * pow(1.6, $lvl-1);
            $res[2] = 75 * pow(1.5, $lvl-1);
            $res[3] = 0;
        }
        else
        {
            $res[1] = $data['res1'] * pow(2, $lvl-1);
            $res[2] = $data['res2'] * pow(2, $lvl-1);
            $res[3] = $data['res3'] * pow(2, $lvl-1);
        }
        return $res;
    }
}
