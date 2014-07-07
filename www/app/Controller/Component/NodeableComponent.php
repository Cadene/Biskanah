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
            if(empty($dtnodes)) {
                $time['start'] = time();
            }else{
                //$last = count($dtbuildings)-1;
                $last = 0;
                $Dtnode = ucfirst($this->to_dtnode($kind));
                $time['start'] = $dtnodes[$last][$Dtnode]['finish'] + 1;
            }
            $time['finish'] = round($time['start'] + $timeToDevelop);

            return $time;
        }


        public function isEnoughResources($data)
        {
            $camp = $this->Data->read('Camp');

            if( (($new['res1'] = $camp['res1'] - $data['res1']) >= 0)
                && (($new['res2'] = $camp['res2'] - $data['res2']) >= 0)
                && (($new['res3'] = $camp['res3'] - $data['res3']) >= 0)
            ) {
                foreach (array(1,2,3) as $i)
                    $this->Data->write('Camp.newres'.$i, $new['res'.$i]);
                return true;
            }

            return false;
        }




    }
