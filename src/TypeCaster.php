<?php

namespace vjik\typeCaster;

use vjik\typeCaster\casters\CompositeCaster;
use vjik\typeCaster\casters\FloatCaster;
use vjik\typeCaster\casters\IntCaster;
use vjik\typeCaster\casters\NullCaster;
use vjik\typeCaster\casters\StringCaster;

class TypeCaster
{

    /**
     * @param mixed $value
     * @param array|null $nullValues
     * @return int|null
     */
    public static function toIntOrNull($value, ?array $nullValues = ['']): ?int
    {
        static $casters;
        $hash = md5(serialize($nullValues));
        if (!isset($casters[$hash])) {
            $casters[$hash] = (new CompositeCaster())->define(new NullCaster(['nullValues' => $nullValues]), new IntCaster());
        }
        return $casters[$hash]->apply($value);
    }

    /**
     * @param mixed $value
     * @param array|null $nullValues
     * @return string|null
     */
    public static function toStringOrNull($value, ?array $nullValues = ['']): ?string
    {
        static $casters;
        $hash = md5(serialize($nullValues));
        if (!isset($casters[$hash])) {
            $casters[$hash] = (new CompositeCaster())->define(new NullCaster(['nullValues' => $nullValues]), new StringCaster());
        }
        return $casters[$hash]->apply($value);
    }

    /**
     * @param mixed $value
     * @param array|null $stringReplacePairs
     * @param array|null $nullValues
     * @return float|null
     */
    public static function toFloatOrNull($value, ?array $stringReplacePairs = [' ' => '', ',' => '.'], ?array $nullValues = ['']): ?float
    {
        static $casters;
        $hash = md5(serialize($stringReplacePairs) . serialize($nullValues));
        if (!isset($casters[$hash])) {
            $casters[$hash] = (new CompositeCaster())->define(
                new NullCaster(['nullValues' => $nullValues]),
                new FloatCaster(['stringReplacePairs' => $stringReplacePairs])
            );
        }
        return $casters[$hash]->apply($value);
    }
}
