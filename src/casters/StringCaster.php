<?php

namespace vjik\typeCaster\casters;

class StringCaster extends BaseCaster
{

    /**
     * @var bool
     */
    public $useTrim = false;

    /**
     * @var string
     */
    public $trimCharList = " \t\n\r\0\x0B";

    /**
     * @inheritDoc
     */
    public function applyToValue($value)
    {
        if (is_object($value) && !method_exists($value, '__toString')) {
            $value = '';
        }
        if (!is_string($value)) {
            $value = (string)$value;
        }
        if ($this->useTrim) {
            $value = trim($value, $this->trimCharList);
        }
        return $value;
    }
}
