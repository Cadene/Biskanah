<?php
App::uses('AppModel', 'Model');
/**
 * Dttechno Model
 *
 * @property Techno $Techno
 * @property Building $Building
 */
class Dttechno extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'techno_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'building_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'finish' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'begin' => array(
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
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Techno' => array(
			'className' => 'Techno',
			'foreignKey' => 'techno_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
	            'Dttechno.building_id' => $building_id
	        ),
	        'fields' => array('*')
	    ));
    }
}
