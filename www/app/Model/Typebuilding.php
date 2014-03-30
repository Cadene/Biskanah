<?php
App::uses('AppModel', 'Model');
/**
 * Typebuilding Model
 *
 */
class Typebuilding extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
	);

    public function findById($id){
        $tmp = $this->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Typebuilding.id' => $id
            )
        ));
        if(empty($tmp))
            return $tmp;
        return $tmp['Typebuilding'];
    }
}
