<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\ValueHelper;

class ValueHelperTest extends TestCase
{

    public function testToNullOrInt()
    {
        $this->assertNull(ValueHelper::toNullOrInt(null));
        $this->assertNull(ValueHelper::toNullOrInt(''));
        $this->assertSame(ValueHelper::toNullOrInt(1), 1);
        $this->assertSame(ValueHelper::toNullOrInt('1'), 1);
    }

    public function testToNullOrString()
    {
        $this->assertNull(ValueHelper::toNullOrString(null));
        $this->assertNull(ValueHelper::toNullOrString(''));
        $this->assertSame(ValueHelper::toNullOrString('1'), '1');
        $this->assertSame(ValueHelper::toNullOrString(2), '2');
    }
}
