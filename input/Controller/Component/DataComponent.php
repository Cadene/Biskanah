<?php
    /**
     * SessionComponent. Provides access to Sessions from the Controller layer
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
     * @package       Cake.Controller.Component
     * @since         CakePHP(tm) v 0.10.0.1232
     * @license       http://www.opensource.org/licenses/mit-license.php MIT License
     */

    App::uses('Component', 'Controller');

    /**
     * The CakePHP SessionComponent provides a way to persist client data between
     * page requests. It acts as a wrapper for the `$_SESSION` as well as providing
     * convenience methods for several `$_SESSION` related functions.
     *
     * @package       Cake.Controller.Component
     * @link http://book.cakephp.org/2.0/en/core-libraries/components/sessions.html
     * @link http://book.cakephp.org/2.0/en/development/sessions.html
     */
    class DataComponent extends Component {

        public $components = array('Session');

        /*
        protected $user;
        protected $technos;
        protected $buildings;
        protected $units;
        protected $camp;
        protected $camps;
        */

        protected $config = array(
            'layout' => array(
                'default' => array( // layout name
                    'resources' => array( // element name
                        'Camp' => array( // Model name
                            'res1',
                            'res2',
                            'res3',
                            'prod1',
                            'prod2',
                            'prod3',
                            'datetime'
                        )
                    ),
                    'camps' => array( // element name
                        'Camps' => array(
                            'Camp' => array(
                                'id',
                                'name',
                                'unread_reports',
                            ),
                            'World' => array(
                                'id',
                                'x',
                                'y',
                            ),
                            'A2b' => array(
                                'id',
                                'type',
                            )
                        )
                    )
                )
            )
        );

        protected $_DATA = array();

        public function writeIfNot($name, $value = array()){
            if(!$this->read($name)){
                return $this->write($name,$value);
            }
        }

        // write comme session
        public function write($name, $value = array()) {
            if (empty($name)) {
                return false;
            }
            $write = $name;
            if (!is_array($name)) {
                $write = array($name => $value);
            }
            foreach ($write as $key => $val) {
                self::_overwrite($this->_DATA, Hash::insert($this->_DATA, $key, $val));
                if (Hash::get($this->_DATA, $key) !== $val) {
                    return false;
                }
            }
            return true;
        }

        /**
         * Comme SessionComponent::read($name), mais vérifie si les données associés à $name sont chargées
         * Si oui les récupères avec _recoverData()
         *
         * @param null $name
         *
         * @return array|bool|mixed|null
         */
        public function read($name=null){
            if ($name === null) {
                return $this->_DATA;
            }
            if (empty($name)) {
                return false;
            }
            if(!isset($this->_DATA[$name])){
                $this->_recoverData($name);
            }
            $result = Hash::get($this->_DATA, $name);

            if (isset($result)) {
                return $result;
            }
            return null;
        }

        protected static function _overwrite(&$old, $new) {
            if (!empty($old)) {
                foreach ($old as $key => $var) {
                    if (!isset($new[$key])) {
                        unset($old[$key]);
                    }
                }
            }
            foreach ($new as $key => $var) {
                $old[$key] = $var;
            }
        }

        /**
         * Vérifie si les données sont chargées, sinon les charge
         *
         * @param $name
         */
        protected function _recoverData($name){
            if($name == 'User'){
                $this->write($name,ClassRegistry::init('User')->findById($this->Session->read('User.id')));
            }
            if($name == 'Ally'){
                $this->write($name,ClassRegistry::init('Ally')->findById($this->Session->read('User.id')));
            }
            if($name == 'Camps'){
                $this->write($name,ClassRegistry::init('Camps')->findByUserId($this->Session->read('User.id')));
            }
            if($name == 'Camp'){
                $this->write($name,ClassRegistry::init('Camp')->findById($this->Session->read('Camp.current')));
            }
            if($name == 'Buildings'){
                $this->write($name,ClassRegistry::init('Building')->findByCampId($this->Session->read('Camp.current')));
            }
        }

        /**
         * Vérifie si les elements sont chargés si le layout en a besoin
         *
         * @param Controller $controller
         */
        protected function _checkElements(Controller $controller)
        {
            if(!isset($this->config['layout'][$controller->layout]))
                return;
            foreach($this->config['layout'][$controller->layout] as $elementName => $elementTables)
            {
                $tableName = key($elementTables);

                //checker dans ->_DATA si les tables sont bien chargées, sinon les charger
                if(!isset($this->_DATA[$tableName])){
                    $functionName = '_recover'.ucfirst($elementName);
                    $this->write($tableName,$this->$functionName($controller));
                }

                //envoyer les données aux différents éléments*/
                $controller->set($elementName,$this->_DATA[$tableName]);
            }
        }


        public function beforeRender(Controller $controller){
            $this->_checkElements($controller);
        }


        protected function _recoverResources(Controller $controller){
            $data = ClassRegistry::init('Camp')->recoverResources($controller->Session->read('Camp.current'));
            return $data['Camp'];
        }

        protected function _recoverCamps(Controller $controller){
            $data = ClassRegistry::init('Camp')->recoverCamps($controller->Session->read('User.id'));
            return $data;
        }


        public function toDataId($type,$lvl=1){
            return $type*100+$lvl;
        }





    }