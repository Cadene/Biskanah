<?php

class Element {

    public static function getKeys()
    {
        foreach (get_class_vars(get_called_class()) as $key=>$value)
        {
            $rslt[$key] = $key;
        }
        return $rslt;
    }

    public function toValues()
    {
        foreach (self::getKeys() as $key=>$value)
        {
            $rslt[$key] = $this->get($key);
        }
        return $rslt;
    }

    public function toString()
    {
        $string = '';

        foreach ($this->toValues() as $key => $value)
        {
            $string .= $key.' : '.$value."\n";
        }
        return $string;
    }
}