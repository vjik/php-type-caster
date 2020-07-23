<?php

namespace vjik\typeCaster;

use vjik\typeCaster\casters\BoolCaster;
use vjik\typeCaster\casters\CompositeCaster;
use vjik\typeCaster\casters\FloatCaster;
use vjik\typeCaster\casters\IntCaster;
use vjik\typeCaster\casters\NullCaster;
use vjik\typeCaster\casters\StringCaster;

class TypeCaster
{

    /**
     * @var array
     */
    public $configNull = [
        'nullValues' => [''],
    ];

    /**
     * @var array
     */
    public $configBool = [
        'trueValues' => ['on', 'yes', 'true'],
        'falseValues' => ['off', 'no', 'false'],
    ];

    /**
     * @var array
     */
    public $configInt = [
        'stringReplacePairs' => [
            ' ' => '',
        ],
    ];

    /**
     * @var array
     */
    public $configFloat = [
        'stringReplacePairs' => [
            ' ' => '',
            ',' => '.'
        ],
    ];

    /**
     * @var array
     */
    public $configString = [];

    private $_nullCaster;

    /**
     * @return NullCaster
     */
    protected function getNullCaster(): NullCaster
    {
        if ($this->_nullCaster === null) {
            $this->_nullCaster = new NullCaster($this->configNull);
        }
        return $this->_nullCaster;
    }

    private $_boolCaster;

    /**
     * @return BoolCaster
     */
    protected function getBoolCaster(): BoolCaster
    {
        if ($this->_boolCaster === null) {
            $this->_boolCaster = new BoolCaster($this->configBool);
        }
        return $this->_boolCaster;
    }

    private $_intCaster;

    /**
     * @return IntCaster
     */
    protected function getIntCaster(): IntCaster
    {
        if ($this->_intCaster === null) {
            $this->_intCaster = new IntCaster($this->configInt);
        }
        return $this->_intCaster;
    }

    private $_floatCaster;

    /**
     * @return FloatCaster
     */
    protected function getFloatCaster(): FloatCaster
    {
        if ($this->_floatCaster === null) {
            $this->_floatCaster = new FloatCaster($this->configFloat);
        }
        return $this->_floatCaster;
    }

    private $_stringCaster;

    /**
     * @return StringCaster
     */
    protected function getStringCaster(): StringCaster
    {
        if ($this->_stringCaster === null) {
            $this->_stringCaster = new StringCaster($this->configString);
        }
        return $this->_stringCaster;
    }

    /**
     * @param $value
     * @return bool
     */
    public function toBool($value): bool
    {
        return $this->getBoolCaster()->forceApply($value);
    }

    /**
     * @param $value
     * @return int
     */
    public function toInt($value): int
    {
        return $this->getIntCaster()->forceApply($value);
    }

    /**
     * @param mixed $value
     * @return float
     */
    public function toFloat($value): float
    {
        return $this->getFloatCaster()->forceApply($value);
    }

    private $_intOrNullCaster;

    /**
     * @param mixed $value
     * @return int|null
     */
    public function toIntOrNull($value): ?int
    {
        if ($this->_intOrNullCaster === null) {
            $this->_intOrNullCaster = (new CompositeCaster())->define(
                $this->getNullCaster(),
                $this->getIntCaster(),
                $this->getNullCaster()
            );
        }
        return $this->_intOrNullCaster->apply($value);
    }

    private $_floatOrNullCaster;

    /**
     * @param mixed $value
     * @return float|null
     */
    public function toFloatOrNull($value): ?float
    {
        if ($this->_floatOrNullCaster === null) {
            $this->_floatOrNullCaster = (new CompositeCaster())->define(
                $this->getNullCaster(),
                $this->getFloatCaster()
            );
        }
        return $this->_floatOrNullCaster->apply($value);
    }

    private $_stringOrNullCaster;

    /**
     * @param mixed $value
     * @return string|null
     */
    public function toStringOrNull($value): ?string
    {
        if ($this->_stringOrNullCaster === null) {
            $this->_stringOrNullCaster = (new CompositeCaster())->define(
                $this->getNullCaster(),
                $this->getStringCaster()
            );
        }
        return $this->_stringOrNullCaster->apply($value);
    }
}
