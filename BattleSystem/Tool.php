<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Tamazy
 * Date: 21/06/2014
 * Time: 13:07
 * To change this template use File | Settings | File Templates.
 */

class Tool {

    /**
     * It returns the distribution (in pourcents) of any array.
     * Ex: [100,100] => [50,50]
     *
     * @param $array
     *
     * @return mixed
     */
    public static function toPc($array)
    {
        $size = count($array);

        if ($size <= 0)
            throw new Exception('Array is too small.');

        $sum = self::sum($array);

        foreach ($array as $value)
        {
            $nArray[] = $value / $sum * 100;
        }
        return $nArray;
    }

    /**
     * From any array, you get its distribution with a change from 0 to $randMax Pc
     * Ex: toPc([100,100]) -> [50,50] => [54,46]
     *
     * @param $array
     * @param $randMax
     *
     * @return Array
     */
    public static function newDistrib($array, $randMax, $size=1)
    {
        if (!is_array($array))
        {
            $array = self::initArray($size,$array);
        }

        // TODO remove
        return self::toPc($array);

        foreach ($array as $value)
        {
            $rand = rand(0,$randMax) / 100;
            $nArray[] = $value * (1 + $rand);
        }
        return self::toPc($nArray);
    }

    /**
     * Sum of the values of an array
     *
     * @param $array
     *
     * @return int
     */
    public static function sum($array)
    {
        $sum = 0;

        foreach ($array as $value)
        {
            $sum += $value;
        }
        return $sum;
    }

    /**
     * Average of the values of an array
     *
     * @param $array
     *
     * @return float
     */
    public static function avg($array)
    {
        $size = count($array);

        return self::sum($array) / $size;
    }

    /**
     * Variance of an array
     *
     * @param $array
     *
     * @return float
     */
    public static function variance($array)
    {
        $variance = 0;
        $avg = self::avg($array);

        foreach ($array as $value)
        {
            $variance += pow($value - $avg, 2);
        }
        return $variance / count($array);
    }

    public static function initArray($size,$value)
    {
        for ($i=0; $i < $size; $i++)
        {
            $array[] = $value;
        }
        return $array;
    }



}