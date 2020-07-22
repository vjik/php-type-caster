<?php

namespace vjik\typeCaster;

class IntCaster extends BaseCaster
{

    /**
     * @inheritDoc
     */
    public function applyToValue($value)
    {
        return (int)$value;
    }
}
