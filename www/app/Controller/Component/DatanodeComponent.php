<?php
    App::uses('Component', 'Controller');

    /**
     * Sert à vérifier les prérequis pour pouvoir construire les batîments, technologies, unités.
     */
    class DatanodeComponent extends Component {

                public $components = array('Session','Data','Nodeable');

        /**
         * @param      $kind [1:buildings|2:technos|3:units]
         * @param      $type
         * @param null $lvl
         */
        public function isAllowed($kind, $type, $lvl=1)
        {
            if (!($kind == 1 || $kind ==2 || $kind ==3))
                throw new NotFoundException(__('Invalid kind : '.$kind));

            if ($lvl === 1)
            {
                $datanodes = ClassRegistry::init('Datanode')->findBy('to',$kind,$type);

                if (empty($datanodes))
                    return true;

                // on regarde si il a les prérequis

                $needed = $this->_neededDatas($datanodes);
                $missed['buildings'] = $this->_missingDatas($needed,'buildings',$type);
                $missed['technos'] = $this->_missingDatas($needed,'technos');

                if (empty($missed['technos']) && empty($missed['buildings']))
                {
                    return true;
                }
                else
                {
                    return $missed;
                }
            }
            else
            {
                if ($kind == 1)
                {
                    //regarde si il a le niveau précédent
                    $buildings = $this->Data->read('Buildings');

                    // TODO à améliorer peut être : une seule requete au lieu d'une boucle
                    foreach ($buildings as $building)
                    {
                        $building = $building['Building'];

                        if ($building['type'] == $type && $building['lvl'] == $lvl - 1)
                            return true;
                    }

                    return false;
                }
                // TODO
            }

        }

        /**
         * A partir d'une liste de data prérequis, fournis les data manquants
         *
         * @param        $needed
         * @param string $kind
         *
         * @return mixed
         * @throws NotImplementedException
         */
        private function _missingDatas($needed,$kind='buildings',$type=0)
        {
            if ($kind != 'buildings' && $kind != 'technos')
                throw new NotImplementedException('Le Kind est incorrect : '.$kind);

            if (isset($needed[$kind]))
            {
                $datas = $this->Data->read(ucfirst($kind));

                $missed = array( $kind => array() );
                foreach($needed[$kind] as $type=>$lvl)
                {
                    // si on a pas le batiment ou qu'il est d'un niveau insuffisant
                    if (!isset($datas[$type]) || $needed[$kind][$type] > current($datas[$type])['lvl'])
                    {
                        $missed[$kind][] = $type;
                    }
                }
                return $missed[$kind];
            }
            return array();
        }

        /**
         * Crée un array de buildings et de technos prérequis
         * ex: array( 'buildings' => array( 'type' => 'lvl' ) )
         *
         * @param $datanodes
         *
         * @return mixed
         */
        private function _neededDatas($datanodes)
        {
            foreach ($datanodes as $key=>$value)
            {
                $value = current($value);

                if ($value['from_kind'] == 1)
                {
                    $needed['buildings'][$value['from_type']] = $value['from_lvl'];
                }
                else
                {
                    $needed['technos'][$value['from_type']] = $value['from_lvl'];
                }
            }
            return $needed;
        }



        /**
         * Retourne tous les noeuds que le joueurs est autorisé à construire,
         * moins ceux qu'il a déjà
         *
         * @param array $data
         *
         * @return array
         */
        public function allowed($nodes='buildings',$databuilding_id='')
        {
            if ($nodes === 'buildings') {
                $from = 1;
                $to = 19;
                $kind = 1;
            } else if ($nodes === 'technos') {
                $kind = 2;
                if ($databuilding_id == 11) {
                    $from = 1;
                    $to = 11;
                } else { // 12
                    $from = 12;
                    $to = 9*3+11;
                }
            } else { // 'units'
                $kind = 3;
                if ($databuilding_id == 7) {
                    $from = 1;
                    $to = 5;
                } else if ($databuilding_id == 8) {
                    $from = 6;
                    $to = 10;
                } else {
                    $from = 11;
                    $to = 15;
                }
            }

            $allowed = array();
            for ($type = $from; $type <= $to; $type++)
            {
                if ($kind == 3 || !$this->Nodeable->doesNodeExist($kind,$type))
                {
                    if ($this->isAllowed($kind,$type) === true)
                    {
                        $allowed[] = $type;
                    }
                }
            }
            return $allowed;
        }










    }
