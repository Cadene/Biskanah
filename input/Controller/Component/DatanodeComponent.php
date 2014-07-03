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

        public $components = array('Session','Data');

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


        // TODO verify Techno
        // TODO verify Unit

        /**
         * Le camp et le joueur ont ils les prérequis nécessaire pour create/upgrade le batiment ?
         *
         * @param $type
         *
         * @return bool
         */
        public function isBuildingAllowed($type)
        {
            // Vérifie si c'est un batiment initial
            if(in_array($type, $this->config['kind']['building']['init']))
                return true;

            // Récupération des prérequis pour le building
            $datanodes = ClassRegistry::init('Datanode')->findByData(
                $this->Data->toDataId($type),
                $this->config['kind']['building']['nb']
            );
            // Vérifier si il y a besoin de prérequis
            if(empty($datanodes))
                return true;

            // TODO finir

            // Indexation par to_data_type
            $indexedDatanodes = $this->indexingDatanodes($datanodes);
            // Indexation par databuilding_id_type si non null
            $indexedBuildings = $this->indexingBuildings($this->Data->read('Buildings'));

            return in_array($type, $this->verifiedBuildings($indexedDatanodes,$indexedBuildings));

            /*if(!isset($data['Technos'])){
                $data['Technos'] = ClassRegistry::init('Techno')->find('all',array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Techno.user_id' => $user_id
                    )
                ));
            }*/
        }

        /**
         * Retourne tous les buildings que le joueur peut créer sur son camp
         *
         * @param array $data
         *
         * @return array
         */
        // TODO ajouter les technologies
        public function allowedBuildings(&$data = array())
        {
            if(!isset($data['User']))
                $user_id = $this->Session->read('User.id');
            if(!isset($data['Camp']))
                $camp_id = $this->Session->read('Camp.current');

            // Récupération des prérequis pour les buildings
            $datanodes = ClassRegistry::init('Datanode')->findByKind($this->config['kind']['building']['nb']);
            // Indexation par to_data_type
            $indexedDatanodes = $this->indexingDatanodes($datanodes);

            // Indexation par databuilding_id_type des batiments
            $indexedBuildings = $this->indexingBuildings($this->Data->read('Buildings'));

            // Mélange les buildings initiaux aux autorisés par les prérequis
            $allowedBuildings = array_merge(
                $this->config['kind']['building']['init'],
                $this->verifiedBuildings($indexedDatanodes,$indexedBuildings)
            );

            /*if(!isset($data['Technos'])){
                $data['Technos'] = ClassRegistry::init('Techno')->find('all',array(
                    'recursive' => -1,
                    'conditions' => array(
                        'Techno.user_id' => $user_id
                    )
                ));
            }*/
            return $allowedBuildings;
        }

        /**
         * Rend les buildings autorisés par les prérequis
         *
         * @param $datanodes indexé par type de batiments
         * @param $databuildings
         *
         * @return array
         */
        public function verifiedbuildings($indexedDatanodes,$indexedBuildings){
            $verifiedbuildings = array();
            foreach($indexedDatanodes as $datanode){
                foreach($datanode as $node){
                    if(isset($indexedBuildings[$node['from_data_type']])
                        && $indexedBuildings[$node['from_data_type']]['databuilding_id_lvl'] >= $node['from_data_lvl']){
                        $verifiedbuildings[] = $node['to_data_type'];
                    }
                }
            }
            return $verifiedbuildings;
        }

        public function indexingBuildings($buildings){
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

        public function indexingDatanodes($datanodes){
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
