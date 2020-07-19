<?php

namespace vjik\valueFilter;

use InvalidArgumentException;

class ValueFilter
{

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string[]
     */
    public $defaultStringToFloatReplacePairs = [
        ' ' => '',
        ',' => '.',
    ];

    /**
     * @var array
     */
    public $defaultNullValues = [null, ''];

    /**
     * @var array|null
     */
    public $defaultTrueValues = null;

    /**
     * @var array|null
     */
    public $defaultFalseValues = null;

    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return int|null
     */
    public function getInt(): ?int
    {
        $this->value = $this->isNull() ? null : (int)$this->value;
        return $this->value;
    }

    /**
     * @param array|null $stringToFloatReplacePairs
     * @return float|null
     */
    public function getFloat(?array $stringToFloatReplacePairs = null): ?float
    {
        if ($this->isNull()) {
            $this->value = null;
        } else {
            if (is_string($this->value)) {
                if ($stringToFloatReplacePairs === null) {
                    $stringToFloatReplacePairs = $this->defaultStringToFloatReplacePairs;
                }
                if ($stringToFloatReplacePairs) {
                    $this->value = strtr($this->value, $stringToFloatReplacePairs);
                }
            }
            $this->value = (float)$this->value;
        }
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getString(): ?string
    {
        $this->value = $this->isNull() ? null : (string)$this->value;
        return $this->value;
    }

    /**
     * @return bool|null
     */
    public function getBool(...$args): ?bool
    {
        if ($this->isNull()) {
            $this->value = null;
        } else {
            switch (count($args)) {
                case 0:
                    $trueValues = $this->defaultTrueValues;
                    $falseValues = $this->defaultFalseValues;
                    break;

                case 1:
                    $trueValues = $args[0];
                    if (!is_array($trueValues)) {
                        $trueValues = [$trueValues];
                    }
                    $falseValues = $this->defaultFalseValues;
                    break;

                case 2:
                    $trueValues = $args[0];
                    if (!is_array($trueValues)) {
                        $trueValues = [$trueValues];
                    }
                    $falseValues = $args[1];
                    if (!is_array($falseValues)) {
                        $falseValues = [$falseValues];
                    }
                    break;

                default:
                    throw new InvalidArgumentException();
            }
            if ($trueValues) {
                $this->convert($trueValues, true);
            }
            if ($falseValues) {
                $this->convert($falseValues, false);
            }
            $this->value = (bool)$this->value;
        }
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $this->value = $this->getCurrentValue();
        return $this->value;
    }

    /**
     * @return mixed
     */
    protected function getCurrentValue()
    {
        return $this->isNull() ? null : $this->value;
    }

    /**
     * @param mixed $from
     * @param mixed $to
     * @return self
     */
    public function convert($from, $to): self
    {
        $value = $this->getCurrentValue();
        if (is_array($from)) {
            if (in_array($value, $from, true)) {
                $this->value = $to;
            }
        } elseif ($this->value === $from) {
            $this->value = $to;
        }
        return $this;
    }

    /**
     * @param mixed $nulls
     * @return self
     */
    public function maybeNull(...$nulls): self
    {
        switch (count($nulls)) {
            case 0:
                $nulls = $this->defaultNullValues;
                break;

            case 1:
                $nulls = $nulls[0];
                if (!is_array($nulls)) {
                    $nulls = [$nulls];
                }
                break;
        }
        return $this->convert($nulls, new NullValue());
    }

    /**
     * @return self
     */
    public function toString(): self
    {
        if (!$this->isNull()) {
            $this->value = (string)$this->value;
        }
        return $this;
    }

    /**
     * @param string $charlist
     * @return self
     */
    public function trim(string $charlist = " \t\n\r\0\x0B"): self
    {
        if (!$this->isNull()) {
            $this->toString()->value = trim($this->value, $charlist);
        }
        return $this;
    }

    /**
     * @return bool
     */
    protected function isNull(): bool
    {
        return $this->value instanceof NullValue;
    }

    /**
     * @param mixed $value
     * @return self
     */
    public static function make($value): self
    {
        return new self($value);
    }
}
