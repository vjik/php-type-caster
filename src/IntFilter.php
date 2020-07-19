<?php

namespace vjik\valueFilter;

class IntFilter extends BaseFilter
{

    /**
     * @inheritDoc
     */
    public function applyToValue($value)
    {
        return (int)$value;
    }
}
