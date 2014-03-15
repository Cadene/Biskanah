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
                    'ressources' => array( // element name
                        'Camp' => array( // Model name
                            'res1',
                            'res2',
                            'res3'
                        )
                    )
                )
            )
        );

        protected $_DATA = array();


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

        public function read($name=null){
            if ($name === null) {
                return $this->_DATA;
            }
            if (empty($name)) {
                return false;
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

   }
