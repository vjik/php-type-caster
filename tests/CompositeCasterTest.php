<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\CompositeCaster;
use vjik\typeCaster\IntCaster;
use vjik\typeCaster\NullCaster;

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
