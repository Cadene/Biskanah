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
                    'table' => 'Buildings'
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
        public function verify($to_data,$to_kind,&$data)
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
                        // TODO verifier
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


        protected function hasBuildingLvl($data,$node){
            foreach($data['Buildings'] as $building){
                $building = current($building);
                // TODO if
                if($building['databuilding_id_type'] == $node['from_data_type']
                    && $building['databuilding_id_lvl'] >= $node['from_data_lvl'])
                    return true;
            }
            return false;
        }

        protected function hasTechnoLvl($data,$node){
            foreach($data['Technos'] as $techno){
                $techno = current($techno);
                // TODO if
                if($techno['datatechno_id_type'] == $node['from_data_type']
                    && $techno['datatechno_id_lvl'] >= $node['from_data_lvl'])
                    return true;
            }
            return false;
        }





    }
