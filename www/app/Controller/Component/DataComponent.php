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

        protected $elements = array(
            'rightmenu' => array('User','Camp','Camps','Team','UnitsCamps', 'Dataunits')
        );

        protected static $_DATA = array();

        // write comme session
        public function write($name, $value = array())
        {
            if (empty($name))
            {
                return false;
            }
            $write = $name;
            if (!is_array($name))
            {
                $write = array($name => $value);
            }
            foreach ($write as $key => $val)
            {
                $this->_overwrite(self::$_DATA, Hash::insert(self::$_DATA, $key, $val));

                if (Hash::get(self::$_DATA, $key) !== $val)
                {
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
        public function read($name=null)
        {
            if ($name === null)
            {
                return self::$_DATA;
            }
            if (empty($name))
            {
                return false;
            }
            if (!isset(self::$_DATA[$name]))
            {
                $this->_recoverData($name);
            }
            $result = Hash::get(self::$_DATA, $name);

            if (isset($result))
            {
                return $result;
            }
            return null;
        }

        protected function _overwrite(&$old, $new)
        {
            if (!empty($old))
            {
                foreach ($old as $key => $var)
                {
                    if (!isset($new[$key]))
                    {
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
                $this->write($name,ClassRegistry::init('User')->findById($user_id));
            }else
            if($name == 'Team'){
                $team_id = $this->read('User.team_id');
                $this->write($name,ClassRegistry::init('Team')->findById($team_id));
            }else
            if($name == 'Camps'){
                $this->write($name,ClassRegistry::init('Camp')->findByUserId($user_id));
            }else
            if($name == 'Camp'){
                $this->write($name,ClassRegistry::init('Camp')->findById($camp_id));
            }else
            if($name == 'Buildings'){
                $this->write($name,ClassRegistry::init('Building')->findByCampId($camp_id));
            }else
            if($name == 'Technos'){
                $this->write($name,ClassRegistry::init('Techno')->findByUserId($user_id));
            }else
            if($name == 'Technos11'){
                $this->write($name,ClassRegistry::init('Techno')->findByUserId($user_id,11));
            }else
            if($name == 'Technos12'){
                $this->write($name,ClassRegistry::init('Techno')->findByUserId($user_id,12));
            }else
            if($name == 'Dtbuildings'){
                $this->write($name,ClassRegistry::init('Dtbuilding')->findByCampId($camp_id));
            }else
            if($name == 'Dttechnos'){
                $this->write($name,ClassRegistry::init('Dttechno')->findByUserId($user_id));
            }else
            if($name == 'Units7'){
                $this->write($name,ClassRegistry::init('UnitsCamp')->findAllbyCamp($camp_id));
            }else
            if ($name == 'UnitsCamps'){
                $this->write($name,ClassRegistry::init('UnitsCamp')->findAllByCamp($camp_id));
            }
        }

        /**
         * Vérifie si les elements sont chargés si le layout en a besoin
         *
         * @param Controller $controller
         */
        protected function _checkElements(Controller $controller)
        {
            foreach ($this->elements as $element=>$models)
            {
                foreach ($models as $model)
                {
                    $data[$element][$model] = $this->read($model);
                }
                $controller->set($element,$data[$element]);
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








    }
