<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\FloatCaster;

class FloatCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new FloatCaster();
        $this->assertSame($caster->apply('12.56'), 12.56);
        $this->assertSame($caster->apply(12.56), 12.56);
    }

    public function testStringReplacePairs()
    {
        $caster = new FloatCaster([
            'stringReplacePairs' => [
                ' ' => '',
                ',' => '.',
            ]
        ]);
        $this->assertSame($caster->apply('1 142,56'), 1142.56);
    }
}
