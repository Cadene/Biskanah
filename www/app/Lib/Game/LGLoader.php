<?php

class LGLoader {

    protected static $_DATA = array();

    public static function write($name, $value)
    {
        if (empty($name)) {
            return false;
        }
        self::$_DATA[$name] = $value;
        return true;
    }

    public static function read($name=null)
    {
        if ($name === null) {
            return self::$_DATA;
        }
        if (empty($name)) {
            return false;
        }
        if(!isset(self::$_DATA[$name])){
            self::_recoverData($name);
        }
        return self::$_DATA[$name];
    }

    protected static function _recoverData($name)
    {


        switch ($name)
        {
            case 'Buildings':
            case 'Technos':
            case 'Units':
                self::_loadElements($name);
                break;

            case 'Requisits':
                $b = self::read('Buildings');
                $t = self::read('Technos');
                $u = self::read('Units');
                self::_loadElements($name,$b,$t,$u);
                break;

            case 'World':
                $className = 'LG'.$name;
                $factName = $className.'Factory';
                App::uses($className,'Lib/Game');
                App::uses($factName,'Lib/Game');
                self::write($name, $factName::make());
                break;
        }
    }


    protected static function _loadElements($name,$b=null,$t=null,$u=null)
    {
        $elementsName = 'LG'.$name;
        $elementName = substr($elementsName,0,-1);
        $factoryName = $elementName.'Factory';

        App::uses($elementName,'Lib/Game');
        App::uses($elementsName,'Lib/Game');
        App::uses($factoryName,'Lib/Game');

        $funcName = 'makeAll';

        if ($b === null)
            self::write($name, $factoryName::$funcName());
        else
            self::write($name, $factoryName::$funcName($b,$t,$u));
    }


}