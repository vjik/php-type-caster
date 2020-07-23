<?php

namespace vjik\typeCaster\casters;

class IntCaster extends BaseCaster
{

    /**
     * @var string[]|null
     */
    public $stringReplacePairs = null;

    /**
     * @inheritDoc
     */
    public function applyToValue($value)
    {
        if (is_string($value)) {
            if ($this->stringReplacePairs) {
                $value = strtr($value, $this->stringReplacePairs);
            }
        }
        return (int)$value;
    }
}
