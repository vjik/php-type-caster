<?php

namespace vjik\typeCaster\casters;

use InvalidArgumentException;

class CompositeCaster extends BaseCaster
{

    /**
     * @inheritDoc
     */
    public $skipOnEmpty = false;

    /**
     * @var BaseCaster[]
     */
    public $filters = [];

    /**
     * @return self
     */
    public function define(...$args): self
    {
        switch (count($args)) {
            case 0:
                throw new InvalidArgumentException();
                break;

            case 1:
                $filters = $args[0];
                if (!is_array($filters)) {
                    $filters = [$filters];
                }
                break;

            default:
                $filters = $args;
                break;
        }
        $this->filters = $filters;
        return $this;
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    protected function applyToValue($value)
    {
        foreach ($this->filters as $filter) {
            $value = $filter->apply($value);
        }
        return $value;
    }
}
