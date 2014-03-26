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

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Components
     *
     * @var array
     */
    public $components = array(
        'Acl',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'camps',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'index'
            ),
            'loginAction' => array(
                'controller' => 'pages',
                'action' => 'index'
            ),
            'authError' => 'Did you really think you are allowed to see that?'
        //,'authorize' => array('Controller')
        ),
        'DebugKit.Toolbar'
    );

    /*public function isAuthorized() {
        if($this->Auth->user('role') == 'admin'){
            return true;
        }else{
            $action = explode('_',$this->action);
            if($action[0] != 'admin'){
                return false;
            }
        }
        return true;
    }*/

    // TODO enlever load DataComponent par défaut
    public function beforeFilter ()
    {
        parent::beforeFilter();
        $this->Data = $this->Components->load('Data');

        // If there is an error like missing controller then do not check permission
        if($this instanceof CakeErrorController)
            return;

        //Configure AuthComponent
        /*$options = ['admin' => false, 'plugin' => false];
        $this->Auth->loginAction = ['controller' => 'users','action' => 'login'] + $options;
        $this->Auth->logoutRedirect = ['controller' => 'users','action' => 'login'] + $options;
        $this->Auth->loginRedirect = ['controller' => 'users','action' => 'index'] + $options;*/
        $this->Auth->allow();

        // If user is not loggin then get anonymous group id
        if(!$this->Auth->user('id'))
        {
            $this->loadModel('Group');
            $group = $this->Group->find('first',
                [
                    'fields'     => 'id,name',
                    'conditions' => ['name' => 'Anonymous']
                ]
            );
            $group_id = $group ? $group['Group']['id'] : (-1);
        }
        // else get the current group id
        else
            $group_id = $this->Auth->user('group_id');

        // get the controller and action from the request and check permission
        $controller =  ucfirst($this->request->controller);
        $action = $this->request->action;
        if(!$this->Acl->check(
            ['model' => 'Group', 'foreign_key' => $group_id],
            $controller.'/'.$action)
        )
        {
            $this->Session->setFlash('You are not allowed to see this page...');
            // if the user's group is anonymous we ask him to loggin
            if(isset($group))
                $this->redirect($this->Auth->loginAction);
            else
                // if the user is not allowed to see this page throw a new exception ...
                throw new ForbiddenActionException('', 403);
        }
    }

}
