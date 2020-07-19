<?php

namespace vjik\valueFilter;

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
            $filter = (new CompositeFilter())->define(new NullFilter(), new IntFilter());
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
            $filter = (new CompositeFilter())->define(new NullFilter(), new StringFilter());
        }
        return $filter->apply($value);
    }
}
