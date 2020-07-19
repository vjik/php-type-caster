<?php

namespace vjik\valueFilterTests;

use PHPUnit\Framework\TestCase;
use vjik\valueFilter\BoolFilter;
use vjik\valueFilter\FloatFilter;
use vjik\valueFilter\IntFilter;
use vjik\valueFilter\NullFilter;
use vjik\valueFilter\StringFilter;
use vjik\valueFilter\CompositeFilter;

class BaseTest extends TestCase
{

    public function testNull()
    {
        $filter = (new CompositeFilter())->define(new NullFilter());
        $this->assertNull($filter->apply(null));
        $this->assertNull($filter->apply(''));
        $this->assertSame($filter->apply(1), 1);

        $nullFilter = new NullFilter(['nullValues' => [1, 2, 3]]);
        $filter = (new CompositeFilter())->define($nullFilter);
        $this->assertNull($filter->apply(2));
        $this->assertSame($filter->apply('2'), '2');
    }

    public function testInt()
    {
        $filter = (new CompositeFilter())->define(new IntFilter([]));
        $this->assertSame($filter->apply('1'), 1);

        $filter = (new CompositeFilter())->define(new IntFilter(['skipOnEmpty' => false]));
        $this->assertSame($filter->apply(null), 0);

        $filter = (new CompositeFilter())->define(new NullFilter(), new IntFilter());
        $this->assertNull($filter->apply(null));
    }

    public function testFloat()
    {
        $filter = (new CompositeFilter())->define(new FloatFilter());
        $this->assertSame($filter->apply('12.56'), 12.56);
        $this->assertSame($filter->apply(12.56), 12.56);
        $this->assertSame($filter->apply('12,56'), 12.56);
        $this->assertSame($filter->apply('1 112,56'), 1112.56);

        $floatFilter = new FloatFilter(['stringReplacePairs' => ['a' => '', 'b' => '', 'c' => 3]]);
        $filter = (new CompositeFilter())->define($floatFilter);
        $this->assertSame($filter->apply('1a1b1c2.12'), 11132.12);

        $filter = (new CompositeFilter())->define(new FloatFilter(['skipOnEmpty' => false]));
        $this->assertSame($filter->apply(null), 0.0);

        $filter = (new CompositeFilter())->define(new NullFilter(), new FloatFilter());
        $this->assertNull($filter->apply(null));
    }

    public function testString()
    {
        $filter = (new CompositeFilter())->define(new StringFilter());
        $this->assertSame($filter->apply('42'), '42');
        $this->assertSame($filter->apply(42), '42');
        $this->assertSame($filter->apply(''), '');

        $filter = (new CompositeFilter())->define(new NullFilter(), new StringFilter());
        $this->assertNull($filter->apply(''));
    }

    public function testTrim()
    {
        $filter = (new CompositeFilter())->define(new StringFilter(['useTrim' => true]));
        $this->assertSame($filter->apply(' test '), 'test');
        $this->assertSame($filter->apply(42), '42');
        $this->assertNull($filter->apply(null));

        $filter = (new CompositeFilter())->define(new StringFilter(['useTrim' => true, 'trimCharList' => 'a']));
        $this->assertSame($filter->apply('aba'), 'b');
    }

    public function testBool()
    {
        $filter = (new CompositeFilter())->define(new BoolFilter());
        $this->assertTrue($filter->apply(true));
        $this->assertFalse($filter->apply(false));
        $this->assertNull($filter->apply(null));
        $this->assertTrue($filter->apply(1));
        $this->assertFalse($filter->apply(0));

        $filter = (new CompositeFilter())->define(new BoolFilter(['trueValues' => [0]]));
        $this->assertTrue($filter->apply(0));

        $filter = (new CompositeFilter())->define(new BoolFilter(['falseValues' => [1]]));
        $this->assertFalse($filter->apply(1));
    }
}
