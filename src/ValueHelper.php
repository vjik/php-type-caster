<?php

namespace vjik\typeCaster;

class ValueHelper
{

    /**
     * @param mixed $value
     * @return int|null
     */
    public static function toNullOrInt($value): ?int
    {
        static $filter;
        if ($filter === null) {
            $filter = (new CompositeCaster())->define(new NullCaster(), new IntCaster());
        }
        return $filter->apply($value);
    }

    /**
     * @param mixed $value
     * @return string|null
     */
    public static function toNullOrString($value): ?string
    {
        static $filter;
        if ($filter === null) {
            $filter = (new CompositeCaster())->define(new NullCaster(), new StringCaster());
        }
        return $filter->apply($value);
    }
}
