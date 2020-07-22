<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\IntCaster;

class IntCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new IntCaster();
        $this->assertSame($caster->apply(''), 0);
        $this->assertSame($caster->apply('1'), 1);
        $this->assertSame($caster->apply(42), 42);
    }
}
