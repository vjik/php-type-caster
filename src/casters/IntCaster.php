<?php

namespace vjik\typeCaster\casters;

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
