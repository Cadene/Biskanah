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
        public function isAllowed($kind,$type,$lvl=1)
        {
            if (!($kind == 1 || $kind ==2 || $kind ==3))
                throw new NotFoundException(__('Invalid kind : '.$kind));

            if ($lvl == 1)
            {
                $datanodes = ClassRegistry::init('Datanode')->findBy('to',$kind,$type);

                if (empty($datanodes))
                    return true;

                // on regarde si il a les prérequis

                $needed = $this->_neededDatas($datanodes);
                $needed['buildings'] = $this->_missingDatas($needed,'buildings');
                $needed['technos'] = $this->_missingDatas($needed,'technos');

                if (empty($needed['technos']) && empty($needed['buildings']))
                {
                    return true;
                }
                else
                {
                    return $needed;
                }
            }
            else
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
        private function _missingDatas($needed,$kind='buildings')
        {
            if ($kind != 'buildings' && $kind != 'technos')
                throw new NotImplementedException('Le Kind est incorrect : '.$kind);

            if (isset($needed[$kind]))
            {
                $datas = $this->Data->read(ucfirst($kind));
                $modelName = ucfirst(substr($kind,0,-1));

                foreach($needed[$kind] as $type)
                {
                    if (isset($datas[$type]) && $datas[$type][$modelName]['lvl'] !=0)
                    {
                        $needed[$kind] = array_diff($needed[$kind],array($type));
                    }
                }
                return $needed[$kind];
            }
            return array();
        }

        /**
         * Crée un array de buildings et de technos prérequis
         *
         * @param $datanodes
         *
         * @return mixed
         */
        private function _neededDatas($datanodes)
        {
            foreach ($datanodes as $key=>$value)
            {
                $value = $value['Datanode'];

                if ($value['from_kind'] == 1)
                {
                    $needed['buildings'][] = $value['from_type'];
                }
                else
                {
                    $needed['technos'][] = $value['from_type'];
                }
            }
            return $needed;
        }





        /**
         * Retourne tous les buildings que le joueur peut créer sur son camp
         *
         * @param array $data
         *
         * @return array
         */
        // TODO à optimiser
        public function allowedBuildings()
        {
            for ($type=1; $type<=18; $type++)
            {
                if (!$this->Nodeable->doesNodeExist(1,$type))
                {
                    if ($this->isAllowed(1,$type) === true)
                        $allowed[] = $type;
                }
            }
            return $allowed;
        }

        public function allowedTechnos($from='laboratory')
        {
            if ($from === 'laboratory')
            {
                for ($type=1; $type<=11; $type++)
                {
                    if ($this->isAllowed(2,$type))
                        $allowed[] = $type;
                }
            }
            else if ($from === 'armory')
            {
                for ($type=12; $type<=9*3+11; $type++)
                {
                    if ($this->isAllowed(2,$type))
                        $allowed[] = $type;
                }
            }
            else
                throw new NotImplementedException('Le $from est incorrect : '.$from);

            return $allowed;
        }








    }
