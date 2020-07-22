<?php

namespace vjik\typeCaster;

class BoolCaster extends BaseCaster
{

    /**
     * @var array|null
     */
    public $trueValues = null;

    /**
     * @var array|null
     */
    public $falseValues = null;

    /**
     * @inheritDoc
     */
    protected function applyToValue($value)
    {
        if ($this->trueValues) {
            $value = Helper::convert($value, $this->trueValues, true);
        }
        if ($this->falseValues) {
            $value = Helper::convert($value, $this->falseValues, false);
        }
        return (bool)$value;
    }
}
