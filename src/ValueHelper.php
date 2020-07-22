<?php

namespace vjik\typeCaster;

use vjik\typeCaster\casters\CompositeCaster;
use vjik\typeCaster\casters\IntCaster;
use vjik\typeCaster\casters\NullCaster;
use vjik\typeCaster\casters\StringCaster;

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
