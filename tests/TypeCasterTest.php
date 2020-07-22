<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\TypeCaster;

class TypeCasterTest extends TestCase
{

    public function testToIntOrNull()
    {
        $this->assertNull(TypeCaster::toIntOrNull(null));
        $this->assertNull(TypeCaster::toIntOrNull(''));
        $this->assertSame(TypeCaster::toIntOrNull(1), 1);
        $this->assertSame(TypeCaster::toIntOrNull('1'), 1);

        $this->assertNull(TypeCaster::toIntOrNull('1', ['1']));
        $this->assertSame(TypeCaster::toIntOrNull('', null), 0);
    }

    public function testToStringOrNull()
    {
        $this->assertNull(TypeCaster::toStringOrNull(null));
        $this->assertNull(TypeCaster::toStringOrNull(''));
        $this->assertSame(TypeCaster::toStringOrNull('1'), '1');
        $this->assertSame(TypeCaster::toStringOrNull(2), '2');

        $this->assertNull(TypeCaster::toStringOrNull('1', ['1']));
        $this->assertSame(TypeCaster::toStringOrNull('', null), '');
    }
}
