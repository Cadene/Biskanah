<?php
App::uses('AppModel', 'Model');
/**
 * CampsUnit Model
 *
 * @property Camp $Camp
 * @property Unit $Unit
 */
class UnitsCamp extends AppModel {

    public function findAllByCamp($camp_id)
    {
        $tmp = $this->find('all',array(
            'recursive' => -1,
            'joins' => array(
                array(
                    'table' => 'dtunits',
                    'alias' => 'Dtunit',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'UnitsCamp.id = Dtunit.unit_camp_id'
                    )
                )
            ),
            'conditions' => array(
                'UnitsCamp.camp_id' => $camp_id
            ),
            'fields' => array(
                '*'
            )
        ));

        return $tmp;
    }

    public function afterFind($results, $primary=false)
    {
        /*App::uses('Data','Controller/Component');
        $this->Data = new DataComponent(new ComponentCollection());
        $data['Buildings'] = $this->Data->read('Buildings');
        $data['Technos'] = $this->Data->read('Technos');*/


        $unitsCamp = array();
        foreach ($results as $k=>$v)
        {
            $type = $results[$k]['UnitsCamp']['dataunit_id'];

            if (!isset($unitsCamp[$type]))
            {
                $unitsCamp[$type]['UnitsCamp'] = $results[$k]['UnitsCamp'];
                $unitsCamp[$type]['UnitsCamp']['type'] = $results[$k]['UnitsCamp']['dataunit_id'];

                if ($results[$k]['Dtunit']['id'] !== null)
                {
                    $finish = $results[$k]['Dtunit']['finish'];
                    $begin = $results[$k]['Dtunit']['begin'];
                    $num = $results[$k]['Dtunit']['num'];

                    $newUnits = floor( (time() - $begin) / (($finish - $begin) / $num) );

                    $unitsCamp[$type]['UnitsCamp']['num'] += $newUnits;
                    $results[$k]['Dtunit']['num'] -= $newUnits;
                }
            }

            if ($results[$k]['Dtunit']['id'] !== null)
            {
                $unitsCamp[$type]['Dtunits'][]['Dtunit'] = $results[$k]['Dtunit'];
            }

        }

        return $unitsCamp;
    }

    public function dtUpdate($dt)
    {
        return $this->updateAll(
            array('num' => 'num + '.current($dt)['num']),
            array('UnitsCamp.id' => current($dt)['unit_camp_id']
        ));
    }
}
