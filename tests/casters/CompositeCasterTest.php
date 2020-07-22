<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\CompositeCaster;
use vjik\typeCaster\casters\IntCaster;
use vjik\typeCaster\casters\NullCaster;

class CompositeCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = (new CompositeCaster())->define(
            new NullCaster(['nullValues' => ['']]),
            new IntCaster()
        );
        $this->assertNull($caster->apply(''));
        $this->assertNull($caster->apply(null));
        $this->assertSame($caster->apply('42'), 42);
    }
}
