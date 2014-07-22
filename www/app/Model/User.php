<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Team $Team
 * @property Camp $Camp
 * @property Invit $Invit
 * @property Rankuser $Rankuser
 * @property Techno $Techno
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'access' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'desc' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'diam' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'plus' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'token' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
		'biskanah' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rank_pts' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rank_units' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'unread_msg' => array(
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
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
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
		'Camp' => array(
			'className' => 'Camp',
			'foreignKey' => 'user_id',
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
		'Invit' => array(
			'className' => 'Invit',
			'foreignKey' => 'user_id',
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
		'Rankuser' => array(
			'className' => 'Rankuser',
			'foreignKey' => 'user_id',
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
		'Techno' => array(
			'className' => 'Techno',
			'foreignKey' => 'user_id',
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
     * @param $username
     *
     * @return array|bool
     */
    public function login($username)
    {
        $data = $this->find('first',array(
            'conditions' => array('username'=>$username),
            'recursive' => -1,
            'joins' => array(
                array(
                    'table' => 'Camps',
                    'alias' => 'Camp',
                    'type' => 'INNER',
                    'foreignKey' => 'user_id',
                    'conditions' => array(
                        'User.id = Camp.user_id'
                    ),
                    'limit' => 1
                )
            ),
            'fields' => array(
                'User.id','User.password','User.email','User.unread_msg','User.team_id',
                'Camp.id'
            )
        ));

        if (empty($data))
            return false;

        $data['User']['username'] = $username;
        $data['Camp']['current'] = $data['Camp']['id'];
        $data['Team']['id'] = $data['User']['team_id'];

        return $data;

        /*die();
        $q = $this->query('SELECT u.id, u.password, u.email, u.access, u.unread_msg, u.team_id '
                        . 'FROM Users u '
                        . 'WHERE u.username = \''.$username.'\' LIMIT 1;');
        $d['User'] = $q[0]['u'];
        if($d['User']['team_id']){
            $q = $this->query('SELECT t.name, t.tag '
                        . 'FROM Teams t '
                        . 'WHERE t.id = \''.$d['User']['team_id'].'\' LIMIT 1;');
            $d['Team'] = $q[0]['t'];
        }
        $q = $this->query('SELECT c.id '
                        . 'FROM Camps c '
                        . 'WHERE c.user_id = \''.$d['User']['id'].'\' LIMIT 1;');
        $d['Camp']['current'] = $q[0]['c']['id'];
        return $d;*/
    }


    public function getUserById($user_id,$d = array()){

        $d = $this->query('SELECT * FROM Users WHERE id=\''.$user_id.'\'');
        return $d;
    }

    public function findByRanks($begin,$count)
    {
        $sql = 'SELECT  uo.*,
                        (
                        SELECT  COUNT(*)
                        FROM    users ui
                        WHERE   (ui.rank_pts, ui.id) >= (uo.rank_pts, uo.id)
                        ) AS rank
                FROM    users uo
                ORDER BY rank DESC';
        $rslt = $this->query($sql);
        return $rslt;
    }

    public function findById($id)
    {
        $tmp = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'User.id' => $id
            ),
            'fields' => array('*')
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['User'];
    }

    public function findByUsername($username)
    {
        $tmp = $this->find('first', array(
            'recursive' => -1,
            'conditions' => array(
                'User.username' => $username
            ),
            'fields' => array('id')
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['User'];
    }


/**
 * MAJ de team_id dans la table Users
 * @param user_id
 * @param team_id
 * */
    public function UpdateTeam($user_id,$team_id){
        $this->query('UPDATE users SET team_id='.$team_id.' WHERE id='.$user_id);
    }

    public function UpdateUnreadMsg($user_id){
        $result = $this->query('SELECT `unread_msg` FROM `Users` WHERE `id`='.$user_id);
        $unread_msg = $result[0]['Users']['unread_msg'];
        $unread_msg++;
        $this->query('UPDATE `Users` SET `unread_msg`=\''.$unread_msg.'\' WHERE `id`='.$user_id);
    }

    public function DowngradeUnreadMsg($user_id){
        if(!$user_id) return;
        $result = $this->query('SELECT `unread_msg` FROM `Users` WHERE `id`='.$user_id);
        $unread_msg = $result[0]['Users']['unread_msg'];
        if($unread_msg > 0 ) $unread_msg--;
        $this->query('UPDATE `Users`SET `unread_msg`=\''.$unread_msg.'\' WHERE `id`='.$user_id);

    }

    /**
     *
     *
     * @param mixed $results
     * @param bool  $primary
     *
     * @return mixed
     */
    public function afterFind($results, $primary=false)
    {
        foreach ($results as $key => $val)
        {
            $val = current($val);
            if (isset($val['rank_pts']))
            {
                $results[$key]['User']['rank_pts_pos'] = $this->_getRankPtsPos($val['rank_pts']);
                $results[$key]['User']['rank_pts'] = floor($results[$key]['User']['rank_pts']/1000);
            }
        }

        return $results;
    }

    private function _getRankPtsPos($rank_pts)
    {
        $sql = 'SELECT COUNT(id)+1 AS pos FROM users WHERE rank_pts > '.$rank_pts;
        $rslt = $this->query($sql);
        return $rslt[0][0]['pos'];
    }
}
