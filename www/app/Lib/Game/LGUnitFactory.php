<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamazy
 * Date: 04/07/2014
 * Time: 05:34
 * To change this template use File | Settings | File Templates.
 */

class LGUnitFactory {

    public static function make($type)
    {
        $id = $type;
        $name[$id] = 'Robot'.$type;
        $desc[$id] = 'Unité d\'élite ne payant pas de mine.';
        $res1[$id] = 60;
        $res2[$id] = 15;
        $res3[$id] = 0;
        $kind[$id] = 10;
        $att1[$id] = 10;
        $att2[$id] = 10;
        $att3[$id] = 10;
        $attb[$id] = 10;
        $armor[$id] = 10;
        $spy[$id] = 10;
        $speed[$id] = 1;
        $conso[$id] = 1;
        $capacity[$id] = 1000;
        $databuilding_id[$id] = 7;

        return new LGUnit($id, $name[$type], $desc[$type],
            $res1[$type], $res2[$type], $res3[$type],
            $kind[$type], $att1[$type], $att2[$type], $att3[$type], $attb[$type],
            $armor[$type], $spy[$type], $speed[$type], $conso[$type], $capacity[$type],
            $databuilding_id[$id]
        );
    }

    public static function makeAll()
    {
        for ($id=1; $id <= 15; $id++)
        {
            $units[$id] = self::make($id);

            if ($id > 10)
            {
                $units[$id]->set('kind',3);
                $units[$id]->set('databuilding_id',9);
            }
            else if ($id > 5)
            {
                $units[$id]->set('kind',2);
                $units[$id]->set('databuilding_id',8);
            }
        }
        return new LGUnits($units);
    }


}