<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\NullCaster;

class NullCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new NullCaster();
        $this->assertNull($caster->apply(null));
        $this->assertSame($caster->apply(42), 42);
    }

    public function testNullValues()
    {
        $caster = new NullCaster(['nullValues' => [0, '']]);
        $this->assertNull($caster->apply(0));
        $this->assertNull($caster->apply(''));
        $this->assertNull($caster->apply(null));
        $this->assertSame($caster->apply('null'), 'null');
    }
}
