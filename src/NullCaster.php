<?php

namespace vjik\typeCaster;

class NullCaster extends BaseCaster
{

    /**
     * @var array
     */
    public $nullValues = [null, ''];

    /**
     * @inheritDoc
     */
    protected function applyToValue($value)
    {
        if ($this->nullValues) {
            $value = Helper::convert($value, $this->nullValues, null);
        }
        return $value;
    }
}
