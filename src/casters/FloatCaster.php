<?php

namespace vjik\typeCaster\casters;

class FloatCaster extends BaseCaster
{

    /**
     * @var string[]|null
     */
    public $stringReplacePairs = null;

    /**
     * @inheritDoc
     */
    protected function applyToValue($value)
    {
        if (is_string($value)) {
            if ($this->stringReplacePairs) {
                $value = strtr($value, $this->stringReplacePairs);
            }
        }
        return (float)$value;
    }
}
