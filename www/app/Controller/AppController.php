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
    public $components = array('Session',
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

    public function beforeFilter (){
        parent::beforeFilter();
        $this->Components->load('Data');
        $this->disableCache();

        if($this->request->controller == 'pages')
        {
            $this->Auth->allow();
        }
        $this->Auth->allow();
    }
}
