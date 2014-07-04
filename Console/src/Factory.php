<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamazy
 * Date: 04/07/2014
 * Time: 05:34
 * To change this template use File | Settings | File Templates.
 */

class Factory {

    public static function makeUnits()
    {
        for ($id=1; $id <= 15; $id++)
        {
            $units[$id] = new Unit($id);

            if ($id >= 10)
                $units[$id]->set('kind',3);
            else if ($id >= 5)
                $units[$id]->set('kind',2);
        }
        return new Units($units);
    }

    public static function makeBuildings()
    {
        for ($id=1; $id <= 18; $id++)
        {
            $buildings[$id] = new Building($id);
        }
        return new Buildings($buildings);
    }

    public static function makeTechnos()
    {
        // Laboratoire
        for ($id=1; $id <= 11; $id++)
        {
            $technos[$id] = new Techno($id);
        }
        // Armurerie
        for ($id=12; $id <= 3*9+12-1; $id++)
        {
            $technos[$id] = new Techno($id,2);
        }
        return new Technos($technos);
    }

    public static function makeWorld()
    {
        return new World(100);
    }

    public static function makeBiskanah()
    {
        $buildings = self::makeBuildings();
        $technos = self::makeTechnos();
        $units = self::makeUnits();
        $world = self::makeWorld();

        return new Biskanah($world,$buildings,$technos,$units);
    }
}