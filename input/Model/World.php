<?php
App::uses('AppModel', 'Model');
/**
 * World Model
 *
 * @property Camp $Camp
 */
class World extends AppModel {

    /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'x' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'y' => array(
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
		'occupied' => array(
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Camp' => array(
			'className' => 'Camp',
			'foreignKey' => 'world_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

/**
 * generateCamp method
 *
 * @var array
 */
    public function generateFirstCamp()
    {
        $d['World']['type'] = 0;
        $d['World']['occupied'] = 1;

        $rayon = sqrt($this->getSize()) / 2;
        $d['World']['x'] = rand(-$rayon-1,$rayon-1);
        $d['World']['y'] = rand(-$rayon-1,$rayon-1);

        $q = $this->query('SELECT id FROM Worlds '
            . ' WHERE x = '.$d['World']['x']
            . ' AND y = '.$d['World']['y'].' LIMIT 1;');
        $d['World']['id'] = $q[0]['Worlds']['id'];

        $this->query('UPDATE Worlds '
            . 'SET type = '.$d['World']['type'].', occupied = '.$d['World']['occupied']
            . ' WHERE id = '.$d['World']['id'].';');

        return $d['World']['id'];
    }



    /*private function getId($x,$y,$max){

    }*/

    private function getSize(){
        $q = $this->query('SELECT COUNT(*) AS size_world FROM Worlds');
        return $q[0][0]['size_world'];
    }

}
