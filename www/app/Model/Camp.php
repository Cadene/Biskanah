<?php
App::uses('AppModel', 'Model', 'Resource');
/**
 * Camp Model
 *
 * @property World $World
 * @property User $User
 * @property Resource $Resource
 * @property Building $Building
 * @property CampsUnit $CampsUnit
 * @property Report $Report
 */
class Camp extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'world_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'resource_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'pts' => array(
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
		'loyalty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'last_update' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unread_reports' => array(
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
		'World' => array(
			'className' => 'World',
			'foreignKey' => 'world_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Building' => array(
			'className' => 'Building',
			'foreignKey' => 'camp_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'CampsUnit' => array(
			'className' => 'CampsUnit',
			'foreignKey' => 'camp_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Report' => array(
			'className' => 'Report',
			'foreignKey' => 'camp_id',
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


    public function generate($d){
        $d['Camp']['user_id'] = $d['User']['id'];
        $d['Camp']['world_id'] = $d['World']['id'];
        $d['Camp']['name'] = 'Default';
        $d['Camp']['pts'] = 0;
        $d['Camp']['type'] = 0;
        $d['Camp']['loyalty'] = 0.0;
        $d['Camp']['last_update'] = time();
        //d['Camp']['created'] = $user_id;
        $d['Camp']['prod1'] = 20;
        $d['Camp']['prod2'] = 10;
        $d['Camp']['prod3'] = 0;
        $d['Camp']['unread_reports'] = 0;
        $d['Camp']['res1'] = 500;
        $d['Camp']['res2'] = 300;
        $d['Camp']['res3'] = 50;
        $d['Camp']['maxres1'] = 1000;
        $d['Camp']['maxres2'] = 1000;
        $d['Camp']['maxres3'] = 1000;

        $this->save($d['Camp']);
        return $this->id;
    }


    public function recoverResources($id){
        return $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.id' => $id
            ),
            'limit' => 1
        ));
    }

    public function recoverCamps($user_id){
        return $this->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.user_id' => $user_id
            ),
            'joins' => array(
                array(
                    'table' => 'Worlds',
                    'alias' => 'World',
                    'type' => 'INNER',
                    'conditions' => array(
                        'World.id = Camp.world_id'
                    )
                )
            ),
            'fields' => array(
                'Camp.id','Camp.name','Camp.unread_reports',
                'World.id','World.x','World.y'
            )
        ));
    }

    public function recover(&$data,$id){
        $tmp = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.id' => $id
            ),
            'fields' => array('*')
        ));
        $data['Camp'] = $tmp['Camp'];
        unset($tmp);
    }

    public function findById($id){
        $tmp = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.id' => $id
            ),
            'fields' => array('*')
        ));
        return $tmp['Camp'];
    }

    public function afterFind($results, $primary=false){
        foreach($results as $key => $val){
            $camp = $val['Camp'];
            if(isset($camp['last_update'])){
                foreach(array(1,2,3) as $i){
                    if(isset($camp['res'.$i]) && isset($camp['prod'.$i])
                        && isset($camp['maxres'.$i]))
                    {
                        $results[$key]['Camp']['currentres'.$i] = ((time() - $camp['last_update']) / 3600)
                                                                    * $camp['prod'.$i] + $camp['res'.$i];
                        if($results[$key]['Camp']['currentres'.$i] >= $camp['maxres'.$i])
                            $results[$key]['Camp']['currentres'.$i] = $camp['maxres'.$i];
                    }
                }

            }
        }
        return $results;
    }
    /*
    public function recoverDataCamp($id){
        $db = $this->getDataSource();
        $data = $db->fetchAll(
            'SELECT * '//(SELECT * FROM `BiskanahV1`.`databuildings` AS `Databuilding` WHERE `Databuilding`.`id` = `Building`.`databuilding_id`)'
            .'FROM `BiskanahV1`.`camps` AS `Camp` '
            .'LEFT JOIN `BiskanahV1`.`worlds` AS `World` ON '
                .'(`World`.`id` = `Camp`.`world_id`) '
            .'LEFT JOIN `BiskanahV1`.`users` AS `User` ON '
                .'(`User`.`id` = `Camp`.`user_id`) '
            .'LEFT JOIN `BiskanahV1`.`buildings` AS `Building` ON '
                .'(`Building`.`camp_id` = `Camp`.`id`) '
            .'WHERE `Camp`.`id` = ? LIMIT 1',
            array($id)
        );
        return $data;
    }*/

}
