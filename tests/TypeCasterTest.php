<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\TypeCaster;

class TypeCasterTest extends TestCase
{

    protected $caster;

    protected function setUp(): void
    {
        $this->caster = new TypeCaster();
    }

    public function testToIntOrNull()
    {
        $this->assertNull($this->caster->toIntOrNull(null));
        $this->assertNull($this->caster->toIntOrNull(''));
        $this->assertSame($this->caster->toIntOrNull(1), 1);
        $this->assertSame($this->caster->toIntOrNull('1'), 1);
        $this->assertSame($this->caster->toIntOrNull('5 200'), 5200);
    }

    public function testToStringOrNull()
    {
        $this->assertNull($this->caster->toStringOrNull(null));
        $this->assertNull($this->caster->toStringOrNull(''));
        $this->assertSame($this->caster->toStringOrNull('1'), '1');
        $this->assertSame($this->caster->toStringOrNull(2), '2');
    }

    public function testToFloat()
    {
        $this->assertSame($this->caster->toFloat(null), 0.0);
        $this->assertSame($this->caster->toFloat(''), 0.0);
        $this->assertSame($this->caster->toFloat(1.25), 1.25);
        $this->assertSame($this->caster->toFloat('1.25'), 1.25);
        $this->assertSame($this->caster->toFloat('1 542,21'), 1542.21);
    }

    public function testToFloatOrNull()
    {
        $this->assertNull($this->caster->toFloatOrNull(null));
        $this->assertNull($this->caster->toFloatOrNull(''));
        $this->assertSame($this->caster->toFloatOrNull(1.25), 1.25);
        $this->assertSame($this->caster->toFloatOrNull('1.25'), 1.25);
        $this->assertSame($this->caster->toFloatOrNull('1 542,21'), 1542.21);
    }

    public function testToBool()
    {
        $this->assertTrue($this->caster->toBool(true));
        $this->assertTrue($this->caster->toBool(1));
        $this->assertTrue($this->caster->toBool('on'));
        $this->assertTrue($this->caster->toBool('yes'));
        $this->assertTrue($this->caster->toBool('true'));

        $this->assertFalse($this->caster->toBool(false));
        $this->assertFalse($this->caster->toBool(0));
        $this->assertFalse($this->caster->toBool('off'));
        $this->assertFalse($this->caster->toBool('no'));
        $this->assertFalse($this->caster->toBool('false'));
        $this->assertFalse($this->caster->toBool(null));
    }
}
