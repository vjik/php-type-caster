<?php

namespace vjik\typeCasterTests\casters;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\casters\StringCaster;

class StringCasterTest extends TestCase
{

    public function testBase()
    {
        $caster = new StringCaster();
        $this->assertSame($caster->apply('42'), '42');
        $this->assertSame($caster->apply(42), '42');
    }

    public function testTrim()
    {
        $caster = new StringCaster(['useTrim' => true]);
        $this->assertSame($caster->apply(' test '), 'test');
        $this->assertSame($caster->apply(42), '42');
    }

    public function testTrimCharList()
    {
        $filter = new StringCaster([
            'useTrim' => true,
            'trimCharList' => 'a1'
        ]);
        $this->assertSame($filter->apply('aba'), 'b');
        $this->assertSame($filter->apply(1711), '7');
    }
}
