<?php

namespace vjik\typeCaster;

class Helper
{

    /**
     * @param object $object
     * @param array $properties
     * @return object
     */
    public static function configure($object, $properties)
    {
        foreach ($properties as $name => $value) {
            $object->$name = $value;
        }
        return $object;
    }

    /**
     * @param mixed $value
     * @param mixed $from
     * @param mixed $to
     * @return mixed
     */
    public static function convert($value, $from, $to)
    {
        if (is_array($from)) {
            if (in_array($value, $from, true)) {
                return $to;
            }
        } elseif ($value === $from) {
            return $to;
        }
        return $value;
    }
}
