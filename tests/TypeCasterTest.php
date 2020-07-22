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

    public function testToFloat()
    {
        $this->assertSame(TypeCaster::toFloat(null), 0.0);
        $this->assertSame(TypeCaster::toFloat(''), 0.0);
        $this->assertSame(TypeCaster::toFloat(1.25), 1.25);
        $this->assertSame(TypeCaster::toFloat('1.25'), 1.25);
        $this->assertSame(TypeCaster::toFloat('1 542,21'), 1542.21);

        $this->assertSame(TypeCaster::toFloat('1 542.21', null), 1.0);
        $this->assertSame(TypeCaster::toFloat('xxx1542.21', ['x' => '']), 1542.21);
    }

    public function testToFloatOrNull()
    {
        $this->assertNull(TypeCaster::toFloatOrNull(null));
        $this->assertNull(TypeCaster::toFloatOrNull(''));
        $this->assertSame(TypeCaster::toFloatOrNull(1.25), 1.25);
        $this->assertSame(TypeCaster::toFloatOrNull('1.25'), 1.25);
        $this->assertSame(TypeCaster::toFloatOrNull('1 542,21'), 1542.21);

        $this->assertSame(TypeCaster::toFloatOrNull('1 542.21', null), 1.0);
        $this->assertSame(TypeCaster::toFloatOrNull('xxx1542.21', ['x' => '']), 1542.21);

        $this->assertNull(TypeCaster::toFloatOrNull('1.25', null, ['1.25']));
        $this->assertSame(TypeCaster::toFloatOrNull('', null, null), 0.0);
        $this->assertSame(TypeCaster::toFloatOrNull(null, null, null), null);
    }

    public function testToBool()
    {
        $this->assertTrue(TypeCaster::toBool(true));
        $this->assertTrue(TypeCaster::toBool(1));
        $this->assertTrue(TypeCaster::toBool('on'));
        $this->assertTrue(TypeCaster::toBool('yes'));
        $this->assertTrue(TypeCaster::toBool('true'));
        $this->assertFalse(TypeCaster::toBool(false));
        $this->assertFalse(TypeCaster::toBool(0));
        $this->assertFalse(TypeCaster::toBool('off'));
        $this->assertFalse(TypeCaster::toBool('no'));
        $this->assertFalse(TypeCaster::toBool('false'));
        $this->assertFalse(TypeCaster::toBool(null));

        $this->assertTrue(TypeCaster::toBool('okay', ['okay']));
        $this->assertfalse(TypeCaster::toBool('bad', null, ['bad']));
    }
}
