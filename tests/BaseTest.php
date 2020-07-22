<?php

namespace vjik\typeCasterTests;

use PHPUnit\Framework\TestCase;
use vjik\typeCaster\BoolCaster;
use vjik\typeCaster\FloatCaster;
use vjik\typeCaster\IntCaster;
use vjik\typeCaster\NullCaster;
use vjik\typeCaster\StringCaster;
use vjik\typeCaster\CompositeCaster;

class BaseTest extends TestCase
{

    public function testNull()
    {
        $filter = (new CompositeCaster())->define(new NullCaster());
        $this->assertNull($filter->apply(null));
        $this->assertNull($filter->apply(''));
        $this->assertSame($filter->apply(1), 1);

        $nullFilter = new NullCaster(['nullValues' => [1, 2, 3]]);
        $filter = (new CompositeCaster())->define($nullFilter);
        $this->assertNull($filter->apply(2));
        $this->assertSame($filter->apply('2'), '2');
    }

    public function testInt()
    {
        $filter = (new CompositeCaster())->define(new IntCaster([]));
        $this->assertSame($filter->apply('1'), 1);

        $filter = (new CompositeCaster())->define(new IntCaster(['skipOnEmpty' => false]));
        $this->assertSame($filter->apply(null), 0);

        $filter = (new CompositeCaster())->define(new NullCaster(), new IntCaster());
        $this->assertNull($filter->apply(null));
    }

    public function testFloat()
    {
        $filter = (new CompositeCaster())->define(new FloatCaster());
        $this->assertSame($filter->apply('12.56'), 12.56);
        $this->assertSame($filter->apply(12.56), 12.56);
        $this->assertSame($filter->apply('12,56'), 12.56);
        $this->assertSame($filter->apply('1 112,56'), 1112.56);

        $floatFilter = new FloatCaster(['stringReplacePairs' => ['a' => '', 'b' => '', 'c' => 3]]);
        $filter = (new CompositeCaster())->define($floatFilter);
        $this->assertSame($filter->apply('1a1b1c2.12'), 11132.12);

        $filter = (new CompositeCaster())->define(new FloatCaster(['skipOnEmpty' => false]));
        $this->assertSame($filter->apply(null), 0.0);

        $filter = (new CompositeCaster())->define(new NullCaster(), new FloatCaster());
        $this->assertNull($filter->apply(null));
    }

    public function testString()
    {
        $filter = (new CompositeCaster())->define(new StringCaster());
        $this->assertSame($filter->apply('42'), '42');
        $this->assertSame($filter->apply(42), '42');
        $this->assertSame($filter->apply(''), '');

        $filter = (new CompositeCaster())->define(new NullCaster(), new StringCaster());
        $this->assertNull($filter->apply(''));
    }

    public function testTrim()
    {
        $filter = (new CompositeCaster())->define(new StringCaster(['useTrim' => true]));
        $this->assertSame($filter->apply(' test '), 'test');
        $this->assertSame($filter->apply(42), '42');
        $this->assertNull($filter->apply(null));

        $filter = (new CompositeCaster())->define(new StringCaster(['useTrim' => true, 'trimCharList' => 'a']));
        $this->assertSame($filter->apply('aba'), 'b');
    }

    public function testBool()
    {
        $filter = (new CompositeCaster())->define(new BoolCaster());
        $this->assertTrue($filter->apply(true));
        $this->assertFalse($filter->apply(false));
        $this->assertNull($filter->apply(null));
        $this->assertTrue($filter->apply(1));
        $this->assertFalse($filter->apply(0));

        $filter = (new CompositeCaster())->define(new BoolCaster(['trueValues' => [0]]));
        $this->assertTrue($filter->apply(0));

        $filter = (new CompositeCaster())->define(new BoolCaster(['falseValues' => [1]]));
        $this->assertFalse($filter->apply(1));
    }
}
