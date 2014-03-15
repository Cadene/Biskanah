<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class GameController extends AppController {


    public function recoverCamp(){
        $this->loadModel('Camp');
        $data = $this->Camp->find('first',array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.id' => $this->Session->read('Camp.current')
            ),
            'limit' => 1
        ));
        return $data['Camp'];
    }

    public function recoverCamps(){
        $this->loadModel('Camp');
        $data = $this->Camp->find('all',array(
            'recursive' => -1,
            'conditions' => array(
                'Camp.user_id' => $this->Session->read('User.id')
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
        return $data;
    }

}
