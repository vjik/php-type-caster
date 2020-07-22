<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\IntCaster;

class BaseTest extends TestCase
{

    public function testSkipOnEmpty()
    {
        $caster = new IntCaster(['skipOnEmpty' => true]);
        $this->assertSame($caster->apply(null), null);

        $caster = new IntCaster(['skipOnEmpty' => false]);
        $this->assertSame($caster->apply(null), 0);
    }
}
