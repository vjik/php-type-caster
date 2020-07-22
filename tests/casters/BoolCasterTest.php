<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\BoolCaster;

class BoolCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new BoolCaster();
        $this->assertTrue($caster->apply(true));
        $this->assertFalse($caster->apply(false));
        $this->assertNull($caster->apply(null));
        $this->assertTrue($caster->apply(1));
        $this->assertFalse($caster->apply(0));
    }

    public function testTrueAndFalseValues()
    {
        $caster = new BoolCaster([
            'trueValues' => ['yes', 'on'],
            'falseValues' => ['no', 'off'],
        ]);
        $this->assertTrue($caster->apply('yes'));
        $this->assertTrue($caster->apply('on'));
        $this->assertFalse($caster->apply('no'));
        $this->assertFalse($caster->apply('off'));
        $this->assertTrue($caster->apply(true));
        $this->assertFalse($caster->apply(false));
    }
}
