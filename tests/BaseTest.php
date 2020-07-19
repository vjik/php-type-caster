<?php

namespace vjik\valueFilterTests;

use PHPUnit\Framework\TestCase;
use vjik\valueFilter\ValueFilter;

class BaseTest extends TestCase
{

    public function testNull()
    {
        $this->assertNull(ValueFilter::make(null)->maybeNull()->getValue());
        $this->assertNull(ValueFilter::make('')->maybeNull()->getValue());
        $this->equalTo(ValueFilter::make(1)->maybeNull()->getValue(), 1);
        $this->assertNull(ValueFilter::make(1)->maybeNull(1)->getValue());
        $this->assertNull(ValueFilter::make(1)->maybeNull(0, 1)->getValue());
        $this->assertNull(ValueFilter::make(1)->maybeNull([0, 1])->getValue());
        $this->assertSame(ValueFilter::make('2')->maybeNull(2)->getValue(), '2');
    }

    public function testInt()
    {
        $this->assertSame(ValueFilter::make('1')->getInt(), 1);
        $this->assertSame(ValueFilter::make(null)->getInt(), 0);
        $this->assertSame(ValueFilter::make(null)->maybeNull()->getInt(), null);
    }

    public function testFloat()
    {
        $this->assertSame(ValueFilter::make('12.56')->getFloat(), 12.56);
        $this->assertSame(ValueFilter::make(12.56)->getFloat(), 12.56);
        $this->assertSame(ValueFilter::make('12,56')->getFloat(), 12.56);
        $this->assertSame(ValueFilter::make('1 112,56')->getFloat(), 1112.56);
        $this->assertSame(ValueFilter::make('1a1b1c2.12')->getFloat(['a' => '', 'b' => '', 'c' => 3]), 11132.12);
        $this->assertSame(ValueFilter::make(null)->getFloat(), 0.0);
        $this->assertSame(ValueFilter::make(null)->maybeNull()->getFloat(), null);
    }

    public function testString()
    {
        $this->assertSame(ValueFilter::make('42')->getString(), '42');
        $this->assertSame(ValueFilter::make(42)->getString(), '42');
        $this->assertSame(ValueFilter::make('')->getString(), '');
        $this->assertSame(ValueFilter::make('')->maybeNull()->getString(), null);
        $this->assertSame(ValueFilter::make(null)->getString(), '');
        $this->assertSame(ValueFilter::make(null)->maybeNull()->getString(), null);
    }

    public function testTrim()
    {
        $this->assertSame(ValueFilter::make(' test ')->trim()->getValue(), 'test');
        $this->assertSame(ValueFilter::make(42)->trim()->getValue(), '42');
        $this->assertSame(ValueFilter::make(null)->trim()->getValue(), '');
        $this->assertSame(ValueFilter::make(null)->maybeNull()->trim()->getValue(), null);
        $this->assertSame(ValueFilter::make('')->trim()->getValue(), '');
        $this->assertSame(ValueFilter::make('')->maybeNull()->trim()->getValue(), null);
        $this->assertSame(ValueFilter::make('aba')->trim('a')->getValue(), 'b');
    }

    public function testBool()
    {
        $this->assertSame(ValueFilter::make(true)->getBool(), true);
        $this->assertSame(ValueFilter::make(false)->getBool(), false);
        $this->assertSame(ValueFilter::make(1)->getBool(), true);
        $this->assertSame(ValueFilter::make(0)->getBool(), false);
        $this->assertSame(ValueFilter::make(0)->getBool([0]), true);
        $this->assertSame(ValueFilter::make(0)->getBool(0), true);
        $this->assertSame(ValueFilter::make(1)->getBool(null, [1]), false);
        $this->assertSame(ValueFilter::make(1)->getBool(null, 1), false);
        $this->assertSame(ValueFilter::make(null)->getBool(null), true);
        $this->assertSame(ValueFilter::make(1)->getBool(null, 1), false);
    }
}
