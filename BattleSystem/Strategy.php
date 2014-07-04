<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamazy
 * Date: 21/06/2014
 * Time: 12:25
 * To change this template use File | Settings | File Templates.
 */

class Strategy {

    private $losesPc;
    private $name;

    public function __construct($name,$losesPc)
    {
        $this->name = $name;
        $this->losesPc = $losesPc;
    }

    public function getLosesPc()
    {
        return $this->losesPc;
    }

    public function getName()
    {
        return $this->name;
    }
}