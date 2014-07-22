<?php
    App::uses('Component', 'Controller');

    /**
     * Contient les fonctions utilent aux buildings, technos, units.
     */
    class NodeableComponent extends Component {

        public $components = array('Session','Data');

        private function to_node($kind)
        {
            $node = array(
                1 => 'building',
                2 => 'techno',
                3 => 'unit'
            );
            return $node[$kind];
        }

        private function to_nodes($kind)
        {
            return $this->to_node($kind).'s';
        }

        private function to_dtnode($kind)
        {
            return 'dt'.$this->to_node($kind);
        }

        /**
         * Vérifie qu'il existe un Node de niveau 0 ou plus
         *
         * @param $field
         *
         * @return bool
         */
        public function doesNodeExist($kind,$type)
        {
            $nodes = $this->Data->read(ucfirst($this->to_nodes($kind)));
            return (isset($nodes[$type]) && $nodes[$type][ucfirst($this->to_node($kind))]['lvl'] >= 0);
        }

        /**
         * A partir de dtbuildings et de son last, si il existe, on rend le beginTime du prochain building
         *
         * @param $dtbuildings
         *
         * @return int
         */
        public function startFinishTimes($kind,$dtnodes,$timeToDevelop)
        {
            if(empty($dtnodes))
            {
                $time['start'] = time();
            }
            else
            {
                $last = 0;
                $Dtnode = ucfirst($this->to_dtnode($kind));
                $lastNodeFinish = $dtnodes[$last][$Dtnode]['finish'];

                if ($lastNodeFinish < time())
                {
                    $time['start'] = time();
                }
                else
                {
                    $time['start'] = $dtnodes[$last][$Dtnode]['finish'] + 1;
                }
            }
            $time['finish'] = round($time['start'] + $timeToDevelop);

            return $time;
        }


        public function isEnoughResources($data,$nbUnits=1)
        {
            $camp = $this->Data->read('Camp');

            if( (($new['res1'] = $camp['res1'] - $data['res1'] * $nbUnits) >= 0)
                && (($new['res2'] = $camp['res2'] - $data['res2'] * $nbUnits) >= 0)
                && (($new['res3'] = $camp['res3'] - $data['res3'] * $nbUnits) >= 0)
            ) {
                foreach (array(1,2,3) as $i)
                    $this->Data->write('Camp.newres'.$i, $new['res'.$i]);
                return true;
            }

            return false;
        }


        /**
         * Buildable, Searchable, Trainable
         *
         * @param Controller $controller
         * @param string     $nodes
         * @param string     $databuilding_id
         */
        public function nodeable(Controller $controller, $nodes='buildings',$databuilding_id='')
        {
            $Nodes = ucfirst($nodes);
            $node = substr($nodes,0,-1);

            $this->DatanodeComponent = $controller->Components->load('Datanode');
            $this->DataComponent = $controller->Components->load('Data');

            $allowedTypes = $this->DatanodeComponent->allowed($nodes,$databuilding_id);

            if ($nodes === 'buildings')
            {
                $data['data'.$nodes] = ClassRegistry::init('Data'.$node)->findAll();
            }
            else if ($nodes === 'technos')
            {
                $data['data'.$nodes] = ClassRegistry::init('Data'.$node)->findAllByDatabuilding($databuilding_id);
            }
            else // 'units'
            {
                $data['data'.$nodes] = ClassRegistry::init('Data'.$node)->findAllByDatabuilding($databuilding_id);
            }

            $data[$nodes] = $this->DataComponent->read($Nodes.$databuilding_id);
            $datanodes = ClassRegistry::init('Datanode')->findNodes($nodes);

            // les nodes qu'on possède
            $nodesTypes = [];
            foreach ($data[$nodes] as $b) {
                $nodesTypes[] = current($b)['type'];
            }

            $datanodesTypes = [];
            foreach ($data['data'.$nodes] as $d) {
                $datanodesTypes[] = current($d)['id'];
            }

            $refusedTypes = array_diff($datanodesTypes,$nodesTypes,$allowedTypes);

            $requiredTypes = [];
            foreach ($datanodes as $d) {
                $d = current($d);
                $requiredTypes[$d['to_type']][$d['from_type']] = $d['from_lvl'];
            }

            if ($nodes !== 'units')
                $controller->view = $controller->view.$databuilding_id;

            /*debug($datanodesTypes);
            debug($nodesTypes);
            debug($allowedTypes);*/

            $controller->set(compact('allowedTypes','refusedTypes','requiredTypes','datanodesTypes'));
            $controller->set('data'.$nodes,$data['data'.$nodes]);
        }




    }
