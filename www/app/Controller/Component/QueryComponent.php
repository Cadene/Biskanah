<?php
    App::uses('Component', 'Controller');

    /**
     * Encapsule la Query POST /OU/ GET
     */
    class QueryComponent extends Component {

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
            $this->_check($name,$value);
            foreach ($write as $key => $val) {
                self::_overwrite($this->_DATA, Hash::insert($this->_DATA, $key, $val));
                if (Hash::get($this->_DATA, $key) !== $val) {
                    return false;
                }
            }
            return true;
        }

        // read come session
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

        protected function _check($name,&$value=array()){
            if($name == 'Building'){
               if(isset($value['type'])){
                   $value['databuilding_id'] = $this->toDataId($value['type'],1);
               }
            }
        }

        public function toDataId($type,$lvl){
            return $type*100+$lvl;
        }





    }
