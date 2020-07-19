<?php

namespace vjik\valueFilter;

class FloatFilter extends BaseFilter
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
