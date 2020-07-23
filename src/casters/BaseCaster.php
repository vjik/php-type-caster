<?php

namespace vjik\typeCaster\casters;

use vjik\typeCaster\Helper;

abstract class BaseCaster
{

    /**
     * @var bool
     */
    public $skipOnEmpty = true;

    /**
     * @param array $config
     */
    public function __construct($config = [])
    {
        if (!empty($config)) {
            Helper::configure($this, $config);
        }
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function apply($value)
    {
        return ($this->skipOnEmpty && $this->isEmpty($value)) ? $value : $this->applyToValue($value);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function forceApply($value)
    {
        return $this->applyToValue($value);
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    abstract protected function applyToValue($value);

    /**
     * @param mixed $value
     * @return bool
     */
    protected function isEmpty($value): bool
    {
        return $value === null;
    }
}
