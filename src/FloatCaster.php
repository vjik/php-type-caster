<?php

namespace vjik\typeCaster;

class FloatCaster extends BaseCaster
{

    /**
     * @var string[]|null
     */
    public $stringReplacePairs = [
        ' ' => '',
        ',' => '.',
    ];

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
