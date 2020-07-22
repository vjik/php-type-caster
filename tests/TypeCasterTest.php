<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\TypeCaster;

class TypeCasterTest extends TestCase
{

    public function testToNullOrInt()
    {
        $this->assertNull(TypeCaster::toNullOrInt(null));
//        $this->assertNull(ValueHelper::toNullOrInt(''));
        $this->assertSame(TypeCaster::toNullOrInt(1), 1);
        $this->assertSame(TypeCaster::toNullOrInt('1'), 1);
    }

    public function testToNullOrString()
    {
        $this->assertNull(TypeCaster::toNullOrString(null));
//        $this->assertNull(ValueHelper::toNullOrString(''));
        $this->assertSame(TypeCaster::toNullOrString('1'), '1');
        $this->assertSame(TypeCaster::toNullOrString(2), '2');
    }
}
