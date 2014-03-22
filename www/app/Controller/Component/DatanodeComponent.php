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
    class DatanodeComponent extends Component {

        public $components = array('Session');

        /*
        protected $user;
        protected $technos;
        protected $buildings;
        protected $units;
        protected $camp;
        protected $camps;*/

        protected $config = array(
            'kind' => array(
                'building' => array(
                    'nb' => 1,
                    'id' => 'databuilding_id',
                    'table' => 'Buildings',
                    'type' => array(
                        'min' => 0,
                        'max' => 19
                    ),
                    'lvl' => array(
                        'min' => 0,
                        'max' => 99
                    ),
                    'init' => array(2,4)
                ),
                'techno' => array(
                    'nb' => 2,
                    'id' => 'datatechno_id',
                    'table' => 'Technos'
                )
            )
        );

        /**
         * Vérifie que le data_id d'un type spécial est créable
         * Récupère tous les buildings du camps et/ou les technos du joueur en fonction des prérequis de Datanode
         *
         * @param $to_data
         * @param $to_kind
         * @param $data
         */
        public function verify(&$data,$to_data,$to_kind)
        {
            // Récupération des prérequis
            $datanode = ClassRegistry::init('Datanode')->find('all',array(
                'conditions' => array(
                    'to_data' => $to_data,
                    'to_kind' => $to_kind
                ),
                'fields' => array(
                    'from_data', 'from_kind'
                )
            ));

            foreach($datanode as $node)
            {
                $node = current($node);
                if($node['from_kind'] == $this->config['kind']['building']['nb'])
                {
                    // Si on possède pas la liste des buildings du camp la récupérer
                    if(!isset($data['Buildings'])){
                        $data['Buildings'] = ClassRegistry::init('Building')->find('all',array(
                            'recursive' => -1,
                            'conditions' => array(
                                'Building.camp_id' => $this->Session->read('Camp.current')
                            )
                        ));
                    }
                    // Vérification de la validité du prérequis séléctionné
                    if(!$this->hasBuildingLvl($data,$node))
                        return false;

                }
                if($node['from_kind'] == $this->config['kind']['techno']['nb']){
                    if(!isset($data['Technos'])){
                        if(!isset($data['Technos'])){
                            $data['Technos'] = ClassRegistry::init('Techno')->find('all',array(
                                'recursive' => -1,
                                'conditions' => array(
                                    'Techno.user_id' => $this->Session->read('User.id')
                                )
                            ));
                        }
                        // Vérification de la validité du prérequis séléctionné
                        if(!$this->hasTechnoLvl($data,$node))
                            return false;
                    }
                }
            }

            return true;
        }


        protected function hasBuildingLvl(&$data,$node){
            foreach($data['Buildings'] as $building){
                $building = current($building);
                if($building['databuilding_id_type'] == $node['from_data_type']
                    && $building['databuilding_id_lvl'] >= $node['from_data_lvl'])
                    return true;
            }
            return false;
        }

        protected function hasTechnoLvl(&$data,$node){
            foreach($data['Technos'] as $techno){
                $techno = current($techno);
                if($techno['datatechno_id_type'] == $node['from_data_type']
                    && $techno['datatechno_id_lvl'] >= $node['from_data_lvl'])
                    return true;
            }
            return false;
        }


        public function buildingsVerified(&$data = array())
        {
            if(!isset($data['User']))
                $user_id = $this->Session->read('User.id');
            if(!isset($data['Camp']))
                $camp_id = $this->Session->read('Camp.current');

            // Récupération des prérequis
            $datanodes = ClassRegistry::init('Datanode')->find('all',array(
                'conditions' => array(
                    'to_kind' => $this->config['kind']['building']['nb']
                ),
                'fields' => array(
                    'from_data', 'from_kind', 'to_data'
                )
            ));

            if(!isset($data['Buildings'])){
                $databuildings = ClassRegistry::init('Building')->find('all',array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Building.camp_id' => $camp_id
                    )
                ));
            }


            debug($databuildings);
            $databuildings = $this->indexingBuildings($databuildings);
            debug($databuildings);
            debug($datanodes);
            $datanodes = $this->indexingDatanodes($datanodes);
            debug($datanodes);


            foreach($datanodes as $datanode){
                foreach($datanode as $node){
                    debug($databuildings[$node['from_data_type']]);
                    if(isset($databuildings[$node['from_data_type']])
                        && $databuildings[$node['from_data_type']]['databuilding_id_lvl'] >= $node['from_data_lvl'])
                        $buildingsVerified[] = $node['to_data_type'];
                }
            }

            $buildingsVerified = array_merge($this->config['kind']['building']['init'],$buildingsVerified);


            debug($buildingsVerified);

            /*if(!isset($data['Technos'])){
                $data['Technos'] = ClassRegistry::init('Techno')->find('all',array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Techno.user_id' => $user_id
                    )
                ));
            }*/
            return $buildingsVerified;
        }

        public function indexingBuildings(&$buildings){
            $indexedBuildings = array();
            foreach($buildings as $building){
                $building = current($building);
                if(!isset($indexedBuildings[$building['databuilding_id_type']])){
                    $indexedBuildings[$building['databuilding_id_type']] = $building;
                }else{
                    if($indexedBuildings[$building['databuilding_id_type']]['databuilding_id_lvl']
                       < $building['databuilding_id_lvl']){
                        $indexedBuildings[$building['databuilding_id_type']] = $building;
                    }
                }
            }
            return $indexedBuildings;
        }

        public function indexingDatanodes(&$datanodes){
            $indexedDatanodes = array();
            // pour chaque noeud
            foreach($datanodes as $datanode){
                $datanode = current($datanode);
                // si le noeud existe pas le créer
                if(!isset($indexedDatanodes[$datanode['to_data_type']])){
                    $indexedDatanodes[$datanode['to_data_type']] = array($datanode);
                // sinon le rajouter
                }else{
                    $indexedDatanodes[$datanode['to_data_type']][] = $datanode;
                }
            }
            return $indexedDatanodes;
        }




    }
