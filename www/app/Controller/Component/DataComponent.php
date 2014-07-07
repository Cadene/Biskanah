<?php
    App::uses('Component', 'Controller');

    /**
     * Sert à stocker dans un array (et pas en session)
     *
     * Contient toutes les informations importantes de l'utilisateur
     */
    class DataComponent extends Component {


        // TODO vérifier l'utilité
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
        protected function _recoverData($name)
        {
            $user_id = $this->Session->read('User.id');
            $camp_id = $this->Session->read('Camp.current');

            if($name == 'User'){
                $this->write($name,ClassRegistry::init('User')->findById());
            }
            if($name == 'Team'){
                $this->write($name,ClassRegistry::init('Team')->findById($user_id));
            }
            if($name == 'Camps'){
                $this->write($name,ClassRegistry::init('Camps')->findByUserId($user_id));
            }
            if($name == 'Camp'){
                $this->write($name,ClassRegistry::init('Camp')->findById($camp_id));
            }
            if($name == 'Buildings'){
                $this->write($name,ClassRegistry::init('Building')->findByCampId($camp_id));
            }
            if($name == 'Technos'){
                $this->write($name,ClassRegistry::init('Techno')->findByUserId($user_id));
            }
            if($name == 'Dtbuildings'){
                $this->write($name,ClassRegistry::init('Dtbuilding')->findByCampId($camp_id));
            }
            if($name == 'Dttechnos'){
                $this->write($name,ClassRegistry::init('Dttechno')->findByUserId($user_id));
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

        /**
         * S'execute avant de rendre la vue
         *
         * @param Controller $controller
         */
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
