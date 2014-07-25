<?php

class LGServerFactory {

    public static function make()
    {
        $buildings = LGBuildingFactory::makeAll();
        $technos = LGTechnoFactory::makeAll();
        $units = LGUnitFactory::makeAll();
        $world = LGWorldFactory::make();
        $requisits = LGRequisitFactory::makeAll($buildings,$technos,$units);

        return new Server($world,$buildings,$technos,$units,$requisits);
    }
}