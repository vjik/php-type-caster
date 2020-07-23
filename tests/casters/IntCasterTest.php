<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\IntCaster;

class IntCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new IntCaster();
        $this->assertSame($caster->apply(''), 0);
        $this->assertSame($caster->apply('1'), 1);
        $this->assertSame($caster->apply(42), 42);
    }

    public function testStringReplacePairs()
    {
        $caster = new IntCaster([
            'stringReplacePairs' => [
                ' ' => '',
            ]
        ]);
        $this->assertSame($caster->apply('1 142'), 1142);
    }
}
